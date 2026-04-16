<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>laravel CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>

    <div class="bg-dark text-center text-white p-3">
      <h1 class="h2">Laravel 12 CRUD Application</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="d-flex justify-content-end p-0 mt-3">
                <a href="{{ route('products.create') }}" class="btn btn-dark">Create Product</a>
            </div>

            <div>
        @if(session('success'))
          <div class="alert alert-success">
        {{ session('success') }}
          </div>
        @endif
            </div>

            <div>
        @if(session('error'))
            <div class="alert alert-danger">
        {{ session('error') }}
            </div>
         @endif
            </div>
            {{-- @if(session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            </div>
            @if(session::has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session::get('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif --}}
            
              </div>
                <div class="card p-0 mt-3">
                    <div class="card-header bg-dark text-white">
                        <h4 class="h4">Products List</h4>
                    </div>

                    <div class="card-body shadow-lg">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th width="100px">Status</th>
                                    <th width="150px">Action</th>
                                </tr>
                            </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <!-- ID -->
                <td>{{ $product->id }}</td>

                <!-- Image -->
                <td>
                    <img 
                        src="{{ asset('images/' . $product->image) }}" 
                        width="100" 
                        class="rounded"
                    >
                </td>

                <!-- Name -->
                <td>{{ $product->name }}</td>

                <!-- Description -->
                <td>{{ $product->description }}</td>

                <!-- Price -->
                <td>{{ $product->price }}</td>

                <!-- Status -->
                <td>
                    @if ($product->status == 'active')
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-danger">Inactive</span>
                    @endif
                </td>

                <!-- Actions -->
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                     <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="7" class="text-center">No products found</td>
            </tr>
        @endforelse
    </tbody>
                           
        
    
     </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
