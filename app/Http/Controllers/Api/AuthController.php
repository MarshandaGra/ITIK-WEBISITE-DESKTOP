<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $identifier = $request->input('nomor_induk')
            ?? $request->input('login')
            ?? $request->input('email');

        if (! is_string($identifier) || $identifier === '') {
            $this->throwLoginError('NISN atau NIP wajib diisi.');
        }

        $validated = $request->validate([
            'password' => ['required', 'string'],
        ], [
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('nomor_induk', $identifier)->first();

        if (! $user && $request->filled('email')) {
            $user = User::where('email', $identifier)->first();
        }

        if (! $user || ! Hash::check($validated['password'], $user->password)) {
            $this->throwLoginError('NISN, NIP, atau password salah.');
        }

        if ($user->role === 'admin') {
            $this->throwLoginError('Akun Administrator silakan masuk melalui halaman login khusus Admin.');
        }

        if ($user->status !== 'aktif') {
            $this->throwLoginError('Akun Anda sudah tidak aktif. Hubungi admin sekolah.');
        }

        $token = $user->createToken('flutter-mobile');

        return response()->json([
            'message' => 'Login berhasil.',
            'token_type' => 'Bearer',
            'token' => $token->plainTextToken,
            'user' => $this->userPayload($user),
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'data' => $this->userPayload($request->user()),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $token = $request->user()->currentAccessToken();

        abort_unless($token, 401, 'Token API tidak ditemukan.');
        $token->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }

    /**
     * @return array{id_user: string, nomor_induk: ?string, nama_lengkap: string, role: string, kelas: ?string, email: ?string, wajib_ganti_password: bool}
     */
    private function userPayload(User $user): array
    {
        return [
            'id_user' => $user->id_user,
            'nomor_induk' => $user->nomor_induk,
            'nama_lengkap' => $user->nama_lengkap,
            'role' => $user->role,
            'kelas' => $user->kelas,
            'email' => $user->email,
            'wajib_ganti_password' => $user->wajib_ganti_password,
        ];
    }

    private function throwLoginError(string $message): never
    {
        throw ValidationException::withMessages([
            'nomor_induk' => [$message],
            'login' => [$message],
            'email' => [$message],
        ]);
    }
}
