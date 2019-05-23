<div class="container">
        <form action="{{ route('voyages.update', ['voyage' => $voyage]) }}"  method="DELETE">
          @csrf
              <div class="form-group">
                  <div class="col-md-6 col-md-offset">
                  </div>
              </div>
        </form>
      </div>
@endsection