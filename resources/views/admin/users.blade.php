@extends('layouts.parent')
@section('title', __('messages.users'))



@section('content')
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title">Recent Orders</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>{{ __('messages.user') }}</th>
                        <th>{{ __('messages.role') }}</th>
                        <th>{{ __('messages.total') }}</th>
                        <th>{{ __('messages.date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name ?? 'Guest' }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                {{ optional($user->order)->flatMap->order_details->sum(fn($d) => $d->price * $d->quantity) ?? 0 }}
                                {{ __('messages.egp') }}
                            </td>


                            <td>{{ $user->created_at ? $user->created_at->format('Y-m-d') : '—' }}</td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">{{ __('messages.No users found') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
