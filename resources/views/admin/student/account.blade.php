<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-02-07 12:36
 */
?>

@extends('admin.dialog')

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-title">
                <a class="h3"> Student Account </a>
            </div>

            <div class="card-header">
                <a>
                    student info: (name: {{ $student->name }}, class: {{ $student->class }})
                </a><br>
                <a> every account not more than 40 character</a>
            </div>

            <div class="card-body">
                <form method="post">
                    @csrf
                    @foreach($ojList as $item)
                        <div class="form-group row">
                            <label for="{{ $item }}account" class="col-sm-2 col-form-label">{{$item}} Account</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="{{$item}}account" placeholder="{{$item}} account" name="{{ $item }}" maxlength="40"
                                       value="{{ isset($accountList[$item]) ? $accountList[$item] : ''}}">
                            </div>
                        </div>
                    @endforeach

                    <input type="submit" value="Submit" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const data = {
            data: function () {
                return {

                }
            },

            methods: {

            }
        }
    </script>
@endsection


