@extends('layout.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center">📩 All Messages</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($messages->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $msg->name }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->subject }}</td>
                    <td>{{ Str::limit($msg->message, 50) }}</td>
                    <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                    <td class="text-center">
                        <a href="{{ route('messages.show', $msg->id) }}" class="btn btn-sm btn-info">View</a>
                        <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this message?')" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $messages->links() }}
    @else
        <div class="alert alert-info text-center">
            No messages found yet.
        </div>
    @endif
</div>
@endsection
