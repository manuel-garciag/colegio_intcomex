<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('teacher_users_id') }}
            {{ Form::text('teacher_users_id', $qualification->teacher_users_id, ['class' => 'form-control' . ($errors->has('teacher_users_id') ? ' is-invalid' : ''), 'placeholder' => 'Teacher Users Id']) }}
            {!! $errors->first('teacher_users_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('student_users_id') }}
            {{ Form::text('student_users_id', $qualification->student_users_id, ['class' => 'form-control' . ($errors->has('student_users_id') ? ' is-invalid' : ''), 'placeholder' => 'Student Users Id']) }}
            {!! $errors->first('student_users_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('status') }}
            {{ Form::text('status', $qualification->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status']) }}
            {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>