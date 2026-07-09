/**
 * analisis.js
 * Logika visualisasi peta sebaran risiko stunting (ECharts), doughnut chart komposisi status,
 * dan bar chart distribusi usia (Chart.js) untuk dashboard analisis admin.
 */

// Mapping nama di GeoJSON -> nama yang dipakai di dashboard
const nameMapping = {
    "KOTA SAMARINDA": "Samarinda",
    "KOTA BALIKPAPAN": "Balikpapan",
    "KOTA BONTANG": "Bontang",
    "KUTAI KARTANEGARA": "Kutai Kartanegara",
    "KUTAI TIMUR": "Kutai Timur",
    "KUTAI BARAT": "Kutai Barat",
    "BERAU": "Berau",
    "PASER": "Paser",
    "PENAJAM PASER UTARA": "Penajam Paser Utara",
    "MAHAKAM ULU": "Mahakam Ulu"
};

// JavaScript to handle quick detail review panel
function showQuickDetail(m) {
    document.getElementById('det-name').textContent = m.child_name || 'Anak';
    document.getElementById('det-id').textContent = 'ID: ' + (m.id ? m.id.substring(0, 8).toUpperCase() : '—');
    document.getElementById('det-age-gender').textContent = m.age_months + ' bulan \u00B7 ' + (m.gender === 'L' ? 'Laki-laki' : 'Perempuan');
    
    const createdDate = new Date(m.created_at);
    const formattedDate = createdDate.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
    document.getElementById('det-date').textContent = formattedDate;
    
    const statusBadge = document.getElementById('det-status-badge');
    let statusLabel = m.status_growth;
    
    statusBadge.className = 'badge border-none px-2 py-1 text-[11px] rounded-full';
    if (m.status_growth === 'Normal') {
        statusLabel = 'Normal';
        statusBadge.classList.add('badge-status-normal');
    } else if (m.status_growth === 'Risiko') {
        statusLabel = 'Risiko';
        statusBadge.classList.add('badge-status-risiko');
    } else if (m.status_growth === 'Stunting') {
        statusLabel = 'Stunting';
        statusBadge.classList.add('badge-status-stunting');
    } else {
        statusLabel = 'Stunting Berat';
        statusBadge.classList.add('bg-red-100', 'text-red-700');
    }
    statusBadge.textContent = statusLabel;
    
    const tbVal = parseFloat(m.height || 0).toFixed(1).replace('.', ',');
    const bbVal = parseFloat(m.weight || 0).toFixed(1).replace('.', ',');
    
    document.getElementById('det-tb').textContent = tbVal + ' cm';
    document.getElementById('det-bb').textContent = bbVal + ' kg';
    document.getElementById('det-asi').textContent = m.asi_eksklusif || 'Ya';
    
    const recsEl = document.getElementById('det-recs');
    if (m.status_growth === 'Normal') {
        recsEl.textContent = 'Pertumbuhan anak dalam batas normal berdasarkan standar WHO. Pertahankan asupan gizi seimbang, lanjutkan ASI/MPASI berkualitas, dan lakukan imunisasi rutin.';
    } else if (m.status_growth === 'Risiko') {
        recsEl.textContent = 'Tinggi badan berdasarkan usia berada di kisaran risiko pendek. Perlu pemantauan gizi secara intensif and evaluasi pertumbuhan berkala.';
    } else {
        recsEl.textContent = 'Tinggi badan berdasarkan usia berada di bawah -2 SD. Sarankan orang tua untuk konsultasi ke Posyandu/Puskesmas, evaluasi pola makan, dan pantau pertumbuhan tiap bulan.';
    }
}

document.addEventListener("DOMContentLoaded", function () {
    // Ambil data dashboard dari global window object
    const totalNormal   = window.analisisData.totalNormal;
    const totalRisiko   = window.analisisData.totalRisiko;
    const totalStunting = window.analisisData.totalStunting;
    const totalBerat    = window.analisisData.totalBerat || 0;
    const kaltimData    = window.analisisData.kaltimData;
    const geoJsonUrl    = window.analisisData.geoJsonUrl;
    const chartAgeData  = window.analisisData.chartAgeData;

    // Hitung min & max untuk visualMap
    const values = Object.values(kaltimData);
    const minVal = values.length ? Math.min.apply(null, values) : 0;
    const maxVal = values.length ? Math.max.apply(null, values) : 10;

    // ==================== 1. PETA KALIMANTAN TIMUR (ECharts) ====================
    const embeddedGeoJson = {
        "type": "FeatureCollection",
        "name": "Kabupaten-Kota (Provinsi Kalimantan Timur)",
        "crs": {
            "type": "name",
            "properties": {
                "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
            }
        },
        "features": []
    };

    const mapContainer = document.getElementById("kaltim-map");
    if (mapContainer && typeof echarts !== "undefined") {
        const mapChart = echarts.init(mapContainer);

        function renderKaltimMap(geoJson) {
            echarts.registerMap("KaltimKab", geoJson);

            const seriesData = geoJson.features.map(f => {
                const rawName     = (f.properties.NAME_2 || f.properties.NAME || "").toUpperCase().trim();
                const displayName = nameMapping[rawName] || rawName;

                // Match secara case-insensitive terhadap key kaltimData
                const dataKey = Object.keys(kaltimData).find(
                    k => k.toLowerCase() === displayName.toLowerCase()
                );
                const val = dataKey ? kaltimData[dataKey] : 0;
                return { name: displayName, value: val };
            });

            const option = {
                tooltip: {
                    trigger: "item",
                    formatter: function (params) {
                        const value = params.value || 0;
                        const percentBase = maxVal || 1;
                        const percent = ((value / percentBase) * 100).toFixed(1);
                        return `
                            <div style="font-size:12px;">
                                <strong>${params.name}</strong><br/>
                                Nilai: ${value}<br/>
                                Perbandingan: ${percent}% dari nilai tertinggi
                            </div>
                        `;
                    }
                },
                visualMap: {
                    min: minVal,
                    max: maxVal,
                    orient: "vertical",
                    left: "left",
                    top: "middle",
                    text: ["Tinggi", "Rendah"],
                    textStyle: { fontSize: 11, color: "#64748b" },
                    inRange: {
                        // Gradasi hijau modern (rendah -> tinggi)
                        color: ["#ecfdf3", "#a7f3d0", "#22c55e", "#15803d"]
                    },
                    calculable: false,
                    itemWidth: 10,
                    itemHeight: 80
                },
                series: [{
                    type: "map",
                    map: "KaltimKab",
                    roam: true,
                    zoom: 1.1,
                    label: {
                        show: true,
                        fontSize: 10,
                        color: "#0f172a"
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontWeight: "600",
                            color: "#0f172a"
                        },
                        itemStyle: {
                            areaColor: "#bfdbfe"
                        }
                    },
                    itemStyle: {
                        borderColor: "#e5e7eb",
                        borderWidth: 1
                    },
                    data: seriesData
                }]
            };

            mapChart.setOption(option);
            window.addEventListener("resize", () => mapChart.resize());
        }

        if (geoJsonUrl) {
            fetch(geoJsonUrl)
                .then(resp => {
                    if (!resp.ok) throw new Error("GeoJSON tidak ditemukan");
                    return resp.json();
                })
                .then(renderKaltimMap)
                .catch(err => {
                    console.warn("Gagal memuat GeoJSON dari url, pakai embedded:", err);
                    renderKaltimMap(embeddedGeoJson);
                });
        } else {
            renderKaltimMap(embeddedGeoJson);
        }
    }

    // ==================== 2. PIE CHART KOMPOSISI STATUS ====================
    const statusCtx = document.getElementById("statusChart");
    if (statusCtx && typeof Chart !== "undefined") {
        new Chart(statusCtx, {
            type: "doughnut",
            data: {
                labels: ["Normal", "Risiko", "Stunting", "Stunting berat"],
                datasets: [{
                    data: [totalNormal, totalRisiko, totalStunting, totalBerat],
                    backgroundColor: ["#22c55e", "#fb923c", "#fb7185", "#b91c1c"],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                cutout: "65%",
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // ==================== 3. BAR CHART DISTRIBUSI USIA ====================
    const ageCtx = document.getElementById("ageChart");
    if (ageCtx && typeof Chart !== "undefined" && chartAgeData) {
        new Chart(ageCtx, {
            type: "bar",
            data: {
                labels: ["0–6", "7–12", "13–24", "25–36", "37–60"],
                datasets: [
                    {
                        label: "Normal",
                        data: [
                            chartAgeData['0-6'] ? chartAgeData['0-6']['Normal'] : 0,
                            chartAgeData['7-12'] ? chartAgeData['7-12']['Normal'] : 0,
                            chartAgeData['13-24'] ? chartAgeData['13-24']['Normal'] : 0,
                            chartAgeData['25-36'] ? chartAgeData['25-36']['Normal'] : 0,
                            chartAgeData['37-60'] ? chartAgeData['37-60']['Normal'] : 0
                        ],
                        backgroundColor: "#22c55e"
                    },
                    {
                        label: "Risiko",
                        data: [
                            chartAgeData['0-6'] ? chartAgeData['0-6']['Risiko'] : 0,
                            chartAgeData['7-12'] ? chartAgeData['7-12']['Risiko'] : 0,
                            chartAgeData['13-24'] ? chartAgeData['13-24']['Risiko'] : 0,
                            chartAgeData['25-36'] ? chartAgeData['25-36']['Risiko'] : 0,
                            chartAgeData['37-60'] ? chartAgeData['37-60']['Risiko'] : 0
                        ],
                        backgroundColor: "#fb923c"
                    },
                    {
                        label: "Stunting",
                        data: [
                            chartAgeData['0-6'] ? chartAgeData['0-6']['Stunting'] : 0,
                            chartAgeData['7-12'] ? chartAgeData['7-12']['Stunting'] : 0,
                            chartAgeData['13-24'] ? chartAgeData['13-24']['Stunting'] : 0,
                            chartAgeData['25-36'] ? chartAgeData['25-36']['Stunting'] : 0,
                            chartAgeData['37-60'] ? chartAgeData['37-60']['Stunting'] : 0
                        ],
                        backgroundColor: "#fb7185"
                    },
                    {
                        label: "Stunting Berat",
                        data: [
                            chartAgeData['0-6'] ? chartAgeData['0-6']['Stunting Berat'] : 0,
                            chartAgeData['7-12'] ? chartAgeData['7-12']['Stunting Berat'] : 0,
                            chartAgeData['13-24'] ? chartAgeData['13-24']['Stunting Berat'] : 0,
                            chartAgeData['25-36'] ? chartAgeData['25-36']['Stunting Berat'] : 0,
                            chartAgeData['37-60'] ? chartAgeData['37-60']['Stunting Berat'] : 0
                        ],
                        backgroundColor: "#b91c1c"
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true,
                        ticks: { font: { size: 11 } }
                    },
                    y: {
                        stacked: true,
                        ticks: {
                            stepSize: 5,
                            font: { size: 11 }
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        labels: { font: { size: 11 } }
                    }
                }
            }
        });
    }
});
