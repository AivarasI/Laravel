@extends('layouts.layout')


@section('title', 'Studentų sąrašas')


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Studentų sąrašas</h2>
        @auth
        <a href="{{ route('students.create') }}" class="btn btn-success">Pridėti studentą</a>
        <a href="{{ route('students.trashed') }}" class="btn btn-success">Rodyti pašalintus</a>
        @endauth
    </div>

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('students.index') }}">Studentai</a>

        <div class="ml-auto">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Prisijungti</a>
                <a href="{{ route('register') }}" class="btn btn-success">Registruotis</a>
            @else
                <span class="mr-2">Sveiki, {{ Auth::user()->name }}!</span>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger">Atsijungti</button>
                </form>
            @endguest
        </div>
    </div>
</nav>



    <table class="table table-striped">
        <thead>
            <tr>
            <th>ID</th>
                <th>Vardas</th>
                <th>Pavardė</th>
                <th>Adresas</th>
                <th>Miestas</th>
                <th>Telefono numeris</th>
                <th>Grupė</th>
                @auth<th>Veiksmai</th>@endauth
            </tr>
        </thead>
        <tbody>
        @foreach ($students as $student)
            <tr>
            <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->surname }}</td>
                <td>{{ $student->address }}</td>
                <td>{{ $student->city->name }}</td>
                <td>{{ $student->phone }}</td>
                <td>{{ $student->group ? $student->group->name : 'Nenurodyta' }}</td>
                


                <td>
                    @auth
                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">Redaguoti</a>
                        
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Ištrinti</button>
                        </form>
                        @endauth
                    </td>
               
            </tr>
            @endforeach


        </tbody>
    </table>


    {{ $students->links() }} <!-- Pagination -->
@endsection
