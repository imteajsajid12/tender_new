<div class="row">
    @foreach ($makers as $maker)
    <div class="col-12">
        <label for="" class="w-100">Maker {{ $maker->id }}</label>
        <textarea name="maker" data-id="{{ $maker->id }}" class="form-control dmInfo_box_{{ $maker->id }}">{{ $maker->decision_maker }}</textarea>
    </div>
    <div class="col-12 text-center">
        <button data-id="{{ $maker->id }}" class="btn editDMBtn">Edit</button>
        <button data-id="{{ $maker->id }}" class="btn deleteDMBtn">Delete</button>
    </div>
    @endforeach
</div>