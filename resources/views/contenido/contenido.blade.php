@extends('index')
@section('contenido')
    <template v-if="menu==0">
        <frm-principal></frm-principal>
    </template>

    <template v-if="menu==1">
        <frm-cliente></frm-cliente>
    </template>

    <template v-if="menu==2">
        <frm-notaventa></frm-notaventa>
    </template>

    <template v-if="menu==4">
        <frm-localidad></frm-localidad>
    </template>

    <template v-if="menu==5">
        <frm-propietario></frm-propietario>
    </template>

    {{-- <template v-if="menu==7">
        <frm-empleado></frm-empleado>
    </template> --}}

    <template v-if="menu==6">
        <frm-propiedad></frm-propiedad>
    </template>

    <template v-if="menu==8">
        <frm-agente></frm-agente>
    </template>

    <template v-if="menu==9">
        <frm-usuario></frm-usuario>
    </template>

    <template v-if="menu==10">
        <frm-pago></frm-pago>
    </template>


@endsection
