@extends('admin.layout')

@section('admin_content')
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Registered Customers</h2>
    <p class="text-gray-500 mt-1 font-medium">View and manage your registered users.</p>
</div>

<div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Name</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Email</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Role</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Registered At</th>
                    <th class="px-8 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full {{ $user->is_admin ? 'bg-blue-50 text-blue-600' : 'bg-green-50 text-green-600' }} flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="font-bold text-gray-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-gray-600 font-medium lowercase italic">{{ $user->email }}</td>
                        <td class="px-8 py-5 text-center">
                            @if($user->is_admin)
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-[10px] font-bold uppercase tracking-widest rounded-full border border-blue-200">
                                    Admin
                                </span>
                            @else
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase tracking-widest rounded-full border border-green-200">
                                    Customer
                                </span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-center text-gray-400 font-medium text-sm">{{ $user->created_at->format('M d, Y') }}</td>
                        <td class="px-8 py-5 text-right">
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Delete">
                                    <i class="bi bi-trash text-lg"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-gray-500 font-medium italic">No customers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($users->hasPages())
        <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection
