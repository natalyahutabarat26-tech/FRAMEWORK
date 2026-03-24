<?php

namespace App\Policies;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProdukPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
        return true; // Atau tambahkan logika untuk menentukan siapa yang bisa melihat daftar produk
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Produk $produk): bool
    {
        //
        return true; // Atau tambahkan logika untuk menentukan siapa yang bisa melihat detail produk
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return true; // Atau tambahkan logika untuk menentukan siapa yang bisa membuat produk baru
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Produk $produk): bool
    {
        //
        return true; // Atau tambahkan logika untuk menentukan siapa yang bisa mengedit produk
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Produk $produk): bool
    {
        //
        return true; // Atau tambahkan logika untuk menentukan siapa yang bisa menghapus produk
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Produk $produk): bool
    {
        //
        return true; // Atau tambahkan logika untuk menentukan siapa yang bisa mengembalikan produk yang dihapus
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Produk $produk): bool
    {
        //
        return true; // Atau tambahkan logika untuk menentukan siapa yang bisa menghapus produk secara permanen
    }
}
