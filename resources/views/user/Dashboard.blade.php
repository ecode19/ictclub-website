@extends('layouts.app')

@include('links')
<h1>NORMAL USER DASHBOARD</h1>


{{ Auth::user()->fullname }}, ({{ Auth::user()->usertype }})
