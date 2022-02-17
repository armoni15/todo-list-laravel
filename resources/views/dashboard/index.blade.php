<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>To Do-List App | Dashboard</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <link href="css/offcanvas.css" rel="stylesheet">
    <link href="css/footers.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark" aria-label="Main navigation">
    <div class="container">
      <a class="navbar-brand font-monospace fw-bold" href="#">TODO-LIST APP</a>
      <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown01">
              <li><a class="dropdown-item" href="/dashboard"><i class="bi bi-layout-text-window-reverse"></i>&ensp; My Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>&ensp; Logout</button>
                  </form>
                </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white bg-secondary rounded shadow-sm">
      <div class="lh-1">
        <h1 class="h4 mb-0 text-white lh-1 font-monospace fw-bold"><i class="bi bi-house-door"></i> Dashboard</h1>
      </div>
      <div class="col-md-3 text-end ms-auto">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah">Create new</button>
      </div>
    </div>
    @if (session()->has('succes'))
      <div class="alert alert-success" role="alert">
        {{ session('succes') }}
      </div>
    @endif

    <!-- Modal Create Form -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create New List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/dashboard/todolists" method="POST">
              @csrf
              <div class="mb-3">
                <label for="Title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="Title" required>
              </div>
              <div class="mb-3">
                <label for="Description" class="form-label">Description</label>
                <textarea class="form-control"  name="description" id="Description" rows="3" required></textarea>
              </div>
              <input type="hidden" name="checklist" value="0">
              <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </form>
        </div>
      </div>
    </div>

    <div class="my-3 p-3 bg-body rounded shadow-sm">
      <h6 class="border-bottom pb-2 mb-0"><i class="bi bi-list-task"></i>&ensp; Latest list</h6>
      <ol class="list-group">
        @foreach ($todolists as $todolist)
        <li class="d-flex justify-content-between align-items-start border-bottom pb-2 mt-2 mb-0">
          <input class="form-check-input flex-shrink-0" @if ($todolist->checklist == 1) checked @endif type="checkbox" style="font-size: 1.375em; margin-right:10px" onclick="$('#form{{ $todolist->id }}').submit()">
          <form id="form{{ $todolist->id }}" action="/dashboard/todolist/completed" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{ $todolist->id }}">
          </form>
          <div class="ms-2 me-auto @if ($todolist->checklist == 1) text-secondary @endif">
            <div class="fw-bold @if ($todolist->checklist == 1) text-decoration-line-through @endif">{{ $todolist->title }}</div>
            {{ $todolist->description }}
          </div>
          <button type="button" title="Edit" class="badge bg-warning rounded-pill text-dark mt-2 border-0"><i class="bi bi-pencil"  data-bs-toggle="modal" data-bs-target="#edit{{ $todolist->id }}"></i></button>&ensp;
          <button  type="button" title="Delete" class="badge bg-danger rounded-pill mt-2 border-0"><i class="bi bi-trash" onclick="confirm('Are you sure?') ? $('#form-delete{{ $todolist->id }}').submit() : false;"></i></button>
          <form id="form-delete{{ $todolist->id }}" action="/dashboard/todolists" method="POST">
            @method('delete')
            @csrf
            <input type="hidden" name="id" value="{{ $todolist->id }}">
          </form>
        </li>
        @endforeach
      </ol><p></p>
      {{ $todolists->links() }}
    </div>
  </main>

  <!-- Modal Edit Form -->
  @foreach ($todolists as $todolist)
  <div class="modal fade" id="edit{{ $todolist->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit {{ $todolist->title }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/dashboard/todolists" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="id" value="{{ $todolist->id }}">
            <div class="mb-3">
              <label for="Title" class="form-label">Title</label>
              <input type="text" name="title" class="form-control" id="Title" value="{{ $todolist->title }}" required>
            </div>
            <div class="mb-3">
              <label for="Description" class="form-label">Description</label>
              <textarea class="form-control"  name="description" id="Description" rows="3" required>{{ $todolist->description }}</textarea>
            </div>
            <input type="hidden" name="checklist" value="{{ $todolist->checklist }}">
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  @endforeach

  <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <span class="text-muted">&copy; 2022 To Do-List, App</span>
      </div>
    </footer>
  </div>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
    <script src="js/offcanvas.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </body>
</html>
