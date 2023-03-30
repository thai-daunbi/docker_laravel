{{-- extends the layouts/app.blade.php --}}
@extends('layouts.app')

@section('content')

	{{-- Start card --}}
    <div class="card shadow">
        <div class="card-body">
            <h4 class="card-title">Create new post</h4>
            <div class="card-text">
                @include('posts.partials.create_post')
                <!-- <input type="file" name="image"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" /> -->
                        
            </div>
        </div>
    </div>
  {{-- End --}}
    
@endsection