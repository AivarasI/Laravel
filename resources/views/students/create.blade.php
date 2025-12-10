@extends('layouts.layout')

@section('content')
<div class="container mt-4">
    <h2>Pridėti naują studentą</h2>
    
    <form action="{{ route('students.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Vardas</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pavardė</label>
            <input type="text" name="surname" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Adresas</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Telefonas</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

    <div class="mb-3">
    <label for="gim_data" class="form-label">Gimimo data</label>
    <input type="date" name="gim_data" class="form-control" value="{{ old('gim_data', $student->gim_data ?? '') }}">

        <div class="mb-3">
            <label class="form-label">Miestas</label>
            <select name="city_id" class="form-control">
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>

       <div class="mb-3">
    <label for="grupe_id" class="form-label">Grupė</label>
    <select name="grupe_id" class="form-select">
        <option value="">Pasirinkite grupę</option>
        @foreach($groups as $group)
            <option value="{{ $group->id }}" {{ old('grupe_id', $student->grupe_id ?? '') == $group->id ? 'selected' : '' }}>
                {{ $group->name }}
            </option>
        @endforeach
    </select>
</div>



        <button type="submit" class="btn btn-success">Išsaugoti</button>
    </form>
</div>
@endsection
