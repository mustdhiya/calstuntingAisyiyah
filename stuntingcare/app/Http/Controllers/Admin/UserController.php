<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display the user list.
     */
    public function index(Request $request)
    {
        $query = User::latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $roleMap = [
                'Admin Wilayah'        => 'admin_wilayah',
                'Koordinator Cabang'   => 'koordinator_cabang',
                'Kader Lapangan'       => 'kader_lapangan',
                'Pengguna Umum'        => 'pengguna_umum',
            ];
            if (isset($roleMap[$request->role])) {
                $query->where('role', $roleMap[$request->role]);
            }
        }

        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50])) {
            $perPage = 10;
        }

        $users     = $query->paginate($perPage)->withQueryString();
        $totalUsers  = User::count();
        $totalAdminKoordinator = User::whereIn('role', ['admin_wilayah', 'koordinator_cabang'])->count();
        $totalKader  = User::where('role', 'kader_lapangan')->count();
        $newUsers30d = User::where('created_at', '>=', now()->subDays(30))->count();

        return view('admin.pengguna', compact(
            'users',
            'totalUsers',
            'totalAdminKoordinator',
            'totalKader',
            'newUsers30d',
        ));
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'role'         => 'required|in:admin_wilayah,koordinator_cabang,kader_lapangan,pengguna_umum',
            'city'         => 'nullable|string|max:255',
            'is_active'    => 'boolean',
        ]);

        $data['password']  = Hash::make($request->input('password', 'password'));
        $data['is_active'] = $request->boolean('is_active', true);

        User::create($data);

        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Update the given user.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'role'         => 'required|in:admin_wilayah,koordinator_cabang,kader_lapangan,pengguna_umum',
            'city'         => 'nullable|string|max:255',
            'is_active'    => 'boolean',
            'password'     => 'nullable|string|min:8',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = $request->boolean('is_active', true);

        $user->update($data);

        return redirect()->route('admin.pengguna')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Delete the given user.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil dihapus.');
    }

    /**
     * Export the filtered user data as CSV.
     */
    public function exportCsv(Request $request)
    {
        $query = User::latest();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone_number', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $roleMap = [
                'Admin Wilayah'        => 'admin_wilayah',
                'Koordinator Cabang'   => 'koordinator_cabang',
                'Kader Lapangan'       => 'kader_lapangan',
                'Pengguna Umum'        => 'pengguna_umum',
            ];
            if (isset($roleMap[$request->role])) {
                $query->where('role', $roleMap[$request->role]);
            }
        }

        $users = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users-export-' . now()->format('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');
            
            // Add UTF-8 BOM for proper Excel compatibility
            fputs($file, "\xEF\xBB\xBF");
            
            // CSV columns header
            fputcsv($file, ['ID', 'Nama', 'Email', 'No. HP', 'Peran', 'Wilayah/Kota', 'Status Aktif', 'Tanggal Dibuat']);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->phone_number ?? '-',
                    ucwords(str_replace('_', ' ', $user->role)),
                    $user->city ?? '-',
                    $user->is_active ? 'Aktif' : 'Nonaktif',
                    $user->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
