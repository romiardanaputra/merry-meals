<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

/**
 * Order Policy
 * Based on ACCESS_CONTROL.md specifications
 */
class OrderPolicy
{
    /**
     * Determine if user can view any orders
     */
    public function viewAny(User $user): bool
    {
        // Super admin, admin can view all
        if (in_array($user->role, ['superadmin', 'admin'])) {
            return true;
        }

        // Other roles can view their own orders
        return in_array($user->role, ['member', 'driver', 'partner']);
    }

    /**
     * Determine if user can view a specific order
     */
    public function view(User $user, Order $order): bool
    {
        // Super admin and admin can view all orders
        if (in_array($user->role, ['superadmin', 'admin'])) {
            return true;
        }

        // Member can view own orders
        if ($user->role === 'member') {
            return $order->userID === $user->id;
        }

        // Driver can view assigned orders
        if ($user->role === 'driver') {
            return $order->volunteerID === $user->id;
        }

        // Partner can view orders for their restaurant
        if ($user->role === 'partner') {
            return $order->partnerID === optional($user->partner)->id;
        }

        return false;
    }

    /**
     * Determine if user can create orders
     */
    public function create(User $user): bool
    {
        // Only members can create orders (place orders)
        return in_array($user->role, ['member', 'superadmin', 'admin']);
    }

    /**
     * Determine if user can update an order
     */
    public function update(User $user, Order $order): bool
    {
        // Super admin and admin can update any order
        if (in_array($user->role, ['superadmin', 'admin'])) {
            return true;
        }

        // Driver can update assigned orders (status changes)
        if ($user->role === 'driver') {
            return $order->volunteerID === $user->id;
        }

        // Partner can update their orders (preparation status)
        if ($user->role === 'partner') {
            return $order->partnerID === optional($user->partner)->id;
        }

        return false;
    }

    /**
     * Determine if user can delete an order
     */
    public function delete(User $user, Order $order): bool
    {
        // Only super admin and admin can delete orders
        return in_array($user->role, ['superadmin', 'admin']);
    }

    /**
     * Determine if user can assign driver to order
     */
    public function assignDriver(User $user, Order $order): bool
    {
        return in_array($user->role, ['superadmin', 'admin']);
    }

    /**
     * Determine if user can update order status
     */
    public function updateStatus(User $user, Order $order): bool
    {
        // Admin can update any status
        if (in_array($user->role, ['superadmin', 'admin'])) {
            return true;
        }

        // Driver can update status of assigned orders
        if ($user->role === 'driver') {
            return $order->volunteerID === $user->id;
        }

        // Partner can update preparation status
        if ($user->role === 'partner') {
            return $order->partnerID === optional($user->partner)->id;
        }

        return false;
    }
}
