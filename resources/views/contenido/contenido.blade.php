@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <frm-principal></frm-principal>
    </template>
@endsection