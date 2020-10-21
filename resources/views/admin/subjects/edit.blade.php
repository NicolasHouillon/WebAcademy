@extends('layouts.admin')

@section('title', "Modification de la matière " . $subject->name)

@section('content')

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
    @endif

    <div>
        <form enctype="multipart/form-data" action="{{route('admin.uploadImage', $subject)}}" method="POST" >
            @csrf
            {{-- l'avatar  --}}
            <div class="image">
                <img src="{{asset($subject->url)}}" id="image" style="width: 15%"> <br>
            </div>
            <label for="image"><strong> Choissisez une image :  </strong></label>
            <input type="file" name="image" id="image" onchange="this.form.submit()">
        </form>
    </div>

    <div>
        <form action="{{ route('admin.subjects.update', $subject) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $subject->name}}">
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('img').setAttribute('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        document.getElementById('avatar').addEventListener('change', function () {
            readURL(this)
        });
    </script>




@endsection
