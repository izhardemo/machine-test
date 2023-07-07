<nav class="navbar navbar-expand-lg bg-dark border-bottom border-bottom-dark" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand" href="{{route('home')}}">Machine Test</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link {{request()->routeIs('buckets*') ? 'active' : ''}}" aria-current="page" href="{{route('buckets.index')}}">Bucket</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{request()->routeIs('balls*') ? 'active' : ''}}" href="{{route('balls.index')}}">Ball</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>