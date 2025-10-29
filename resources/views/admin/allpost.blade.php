<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(Auth::check() && Auth::user()->usertype == 'admin')
            {{ __('Admin Dashboard') }}
            @else
            {{ __('User Dashboard') }}
            @endif
        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                        <div style="background-color: lightcoral" class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 style="color: #333; text-align: center; margin-bottom: 30px;">Posts Management</h1>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse; background-color: white; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
                            <thead>
                                <tr style="background-color: #4CAF50; color: white;">
                                    <th style="padding: 12px 15px; text-align: left;">ID</th>
                                    <th style="padding: 12px 15px; text-align: left;">Title</th>
                                    <th style="padding: 12px 15px; text-align: left;">Description</th>
                                    <th style="padding: 12px 15px; text-align: left;">Image</th>
                                    <th style="padding: 12px 15px; text-align: left;">Update</th>
                                    <th style="padding: 12px 15px; text-align: left;">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($post as $posts)
                                <tr id="post-row-{{ $posts->id }}" style="border-bottom: 1px solid #ddd;">
                                    <td style="padding: 12px 15px;">{{$posts->id}}</td>
                                    <td style="padding: 12px 15px;">{{$posts->title}}</td>
                                    <td style="padding: 12px 15px;">{{Str::limit($posts->description,100)}}</td>
                                    <td style="padding: 12px 15px;">
                                        <img style="width: 100px; height: 100px;" src="{{asset('img/'.$posts->image)}}" alt="{{$posts->image}}">
                                    </td>
                                    <td style="padding: 12px 15px;">
                                        <a href="{{ route('admin.update',$posts->id) }}" style="background-color: #2196F3; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer; margin-right: 5px;">Update</a>
                                    </td>
                                    <td style="padding: 12px 15px;">
                                        <button onclick="deletePost({{ $posts->id }})" style="background-color: #f44336; color: white; border: none; padding: 6px 12px; border-radius: 4px; cursor: pointer;">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div style="margin-top: 20px; text-align: center;">
                        {{ $post->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- jQuery & SweetAlert --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deletePost(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This post will be deleted permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/dashboard/allpost/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if(response.success){
                                $('#post-row-' + id).remove();
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                            }
                        },
                        error: function(xhr){
                            Swal.fire(
                                'Error!',
                                'Something went wrong!',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
    @endsection
</x-app-layout>
