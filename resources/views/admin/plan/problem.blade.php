<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-02-08 18:42
 */
?>

@extends('admin.dialog')

@section('main')
    <div class="container">
        <div class="card">
            <div class="card-title">
                <a class="h3"> Problem in Plan </a>
            </div>

            <div class="card-header">
                <a>
                    plan name: {{ $plan->name }}
                </a>
            </div>

            <div class="card-body">
                <form method="GET" class="form-inline">

                    <div class="form-group mb-2 ">
                        <label for="categorySelect" class="sr-only">category</label>
                        <select id="categorySelect" class="form-control" name="category">
                            <option value="" {{ Request::get('category', null) == null ? 'selected': '' }}> Category... </option>
                            @foreach($categoryGroup as $category)
                                <option value="{{ $category->id }}" {{ Request::get('category', null) == $category->id ? 'selected': '' }}> {{ $category->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <label for="ojSelect" class="sr-only">oj</label>
                        <select id="ojSelect" class="form-control" name="oj">
                            <option value="" {{ Request::get('oj', null) == null ? 'selected': '' }}> Origin OJ... </option>
                            @foreach($ojList as $oj)
                                <option value="{{ $oj }}" {{ Request::get('oj', null) == $oj ? 'selected': '' }}> {{ $oj }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <input type="submit"class="form-control btn btn-primary" id="SubmitButton" value="Search">
                    </div>
                </form>

                <el-table :data="problemList">

                </el-table>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script>
        const data = {
            data :function () {
                return {
                    problemList: JSON.parse('@json('problems')').data,
                }
            },

            method: {

            }
        }
    </script>
@endsection
