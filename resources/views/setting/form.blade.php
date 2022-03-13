<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nota_minima') }}
            {{ Form::text('nota_minima', $setting->nota_minima, ['class' => 'form-control' . ($errors->has('nota_minima') ? ' is-invalid' : ''), 'placeholder' => 'Nota Minima']) }}
            {!! $errors->first('nota_minima', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('num_notas') }}
            {{ Form::text('num_notas', $setting->num_notas, ['class' => 'form-control' . ($errors->has('num_notas') ? ' is-invalid' : ''), 'placeholder' => 'Num Notas']) }}
            {!! $errors->first('num_notas', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $setting->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>