<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-02-07 22:28
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
                    plan name: {{ $plan->name }}
                </a>
            </div>

            <div class="card-body">
                <form method="GET" class="form-inline">
                    <div class="form-group mb-2">
                        <label for="studentName" class="sr-only">Name</label>
                        <input type="text"class="form-control" id="studentName" name="name" placeholder="student name" value="{{ Request::get('name') }}">
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <label for="className" class="sr-only">Class</label>
                        <input type="text"class="form-control" id="className" name="class" placeholder="student class" value="{{ Request::get('class') }}">
                    </div>

                    <div class="form-group mb-2 mx-sm-3">
                        <input type="submit"class="form-control btn btn-primary" id="SubmitButton" value="Search">
                    </div>
                </form>

                <el-table :data="studentList" style="width: 100%" stripe>
                    <el-table-column type="index" width="150"></el-table-column>
                    <el-table-column prop="name" label="name" width="180"> </el-table-column>
                    <el-table-column prop="class" label="class" width="150"> </el-table-column>

                    <el-table-column label="status" width="180">
                        <template slot-scope="scope">

                        </template>
                    </el-table-column>
                </el-table>

                <div class="link justify-content-center">
                    {{ $students->appends(Request::query())->links() }}
                </div>
            </div>


        </div>
    </div>
@endsection

@section('script')
    <script>
        const data = {
            data :function () {
                return {
                    studentList: JSON.parse('@JSON($students)').data,
                }
            },
            method: {

            }
        }
    </script>
@endsection