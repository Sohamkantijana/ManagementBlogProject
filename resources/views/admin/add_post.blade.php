<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (Auth::check() && Auth::user()->usertype == 'admin')
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
                    <div class="p-6 text-gray-900" style="text-align: center; border: 1px solid blue">

                        <div id="responseMsg"></div>

                        <form id="postForm" enctype="multipart/form-data">
                            @csrf
                            <input type="text" id="title" name="title"
                                placeholder="Enter the post Title here!"><br><br><br>
                            <textarea style="width: 300px; height: 300px;" id="description" name="description" placeholder="Write The post here!"></textarea><br><br><br>

                            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png"><br><br><br>

                            <button type="submit" style="border: 1px solid blue; text-align: center; padding: 10px;">Add
                                Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- JS & jQuery --}}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                // Image validation (100KB - 1MB)
                $('#image').on('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const sizeKB = file.size / 1024;
                        if (sizeKB < 100 || sizeKB > 1024) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Invalid Image Size',
                                text: 'Please select an image between 100KB and 1MB.',
                            });
                            $(this).val('');
                        }
                    }
                });

                // Form submit via AJAX
                $('#postForm').on('submit', function(e) {
                    e.preventDefault();

                    let title = $('#title').val().trim();
                    let desc = $('#description').val().trim();
                    let image = $('#image').val().trim();

                    // Basic validation
                    if (!title || !desc || !image) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Empty Fields',
                            text: 'Please fill all fields before submitting.',
                        });
                        return;
                    }

                    let formData = new FormData(this);

                    $.ajax({
                        url: "{{ route('admin.createpost') }}",
                        method: "POST",
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Uploading...',
                                text: 'Please wait while your post is being created.',
                                allowOutsideClick: false,
                                didOpen: () => Swal.showLoading()
                            });
                        },
                        success: function(response) {
                            Swal.close();
                            Swal.fire({
                                icon: 'success',
                                title: 'Post Created Successfully!',
                                text: 'Your post has been uploaded.',
                            });
                            $('#postForm')[0].reset();
                        },
                        error: function(xhr) {
                            Swal.close();
                            let message = 'Something went wrong!';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                message = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Upload Failed',
                                text: message,
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>
