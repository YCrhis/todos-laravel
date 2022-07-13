@extends('app')



@section('content')
<div class="container w-25 border p-4 my-4">
    <div class="row mx-auto">
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        @if(session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

        @error('name')
            <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <label for="name" class="form-label">Name of the category</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color of the category:</label>
            <input type="color" class="form-control" name="color">
        </div>
        
        <button type="submit" class="btn btn-primary">New Category</button>
    </form>
    <div>
        @foreach($categories as $category)
        <div class="row py-1 d-flex justify-content-between">
            <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('categories.show', ['category' => $category->id]) }}" class="d-flex align-items-center gap-2">{{ $category->name }}</a>
                <span style="background-color: {{ $category->color}}" class="color-container"></span>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$category->id}}">Eliminar</button>
            </div>
        </div>

        <!-- modal -->
        <div class="modal fade" id="modal-{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to delete {{ $category->name }} ?
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}" >
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    
                </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</div>

@endsection