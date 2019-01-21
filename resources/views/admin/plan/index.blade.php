<?php
/**
 *
 * Created by Dream.
 * User: Boxjan
 * Datetime: 2019-01-18 19:04
 */
?>

@extends('admin.layout')


@php
    $plans = \App\Model\Plan::all();
@endphp

@section('main')
    <div class="el-card">
        <div class="el-card__header">
            <div class="title">Plan List</div>
        </div>
        <div class="el-card__body">
            <el-table
                    :data="tableData3"
                    style="width: 100%"
                    height="250">
                <el-table-column
                        fixed
                        prop="date"
                        label="日期"
                        width="150">
                </el-table-column>
                <el-table-column
                        prop="name"
                        label="姓名"
                        width="120">
                </el-table-column>
                <el-table-column
                        prop="province"
                        label="省份"
                        width="120">
                </el-table-column>
                <el-table-column
                        prop="city"
                        label="市区"
                        width="120">
                </el-table-column>
                <el-table-column
                        prop="address"
                        label="地址"
                        width="300">
                </el-table-column>
                <el-table-column
                        prop="zip"
                        label="邮编"
                        width="120">
                </el-table-column>
                <el-table-column
                        fixed="right"
                        label="操作"
                        width="120">
                    <template slot-scope="scope">
                        <el-button
                                @click.native.prevent="deleteRow(scope.$index, tableData4)"
                                type="text"
                                size="small">
                            移除
                        </el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const data = {
            data: function () {
                return {

                    tableData3: [{
                        date: '2016-05-03',
                        name: '王小虎',
                        province: '上海',
                        city: '普陀区',
                        address: '上海市普陀区金沙江路 1518 弄',
                        zip: 200333
                    }, {
                        date: '2016-05-02',
                        name: '王小虎',
                        province: '上海',
                        city: '普陀区',
                        address: '上海市普陀区金沙江路 1518 弄',
                        zip: 200333
                    }, {
                        date: '2016-05-04',
                        name: '王小虎',
                        province: '上海',
                        city: '普陀区',
                        address: '上海市普陀区金沙江路 1518 弄',
                        zip: 200333
                    }, {
                        date: '2016-05-01',
                        name: '王小虎',
                        province: '上海',
                        city: '普陀区',
                        address: '上海市普陀区金沙江路 1518 弄',
                        zip: 200333
                    }, {
                        date: '2016-05-08',
                        name: '王小虎',
                        province: '上海',
                        city: '普陀区',
                        address: '上海市普陀区金沙江路 1518 弄',
                        zip: 200333
                    }, {
                        date: '2016-05-06',
                        name: '王小虎',
                        province: '上海',
                        city: '普陀区',
                        address: '上海市普陀区金沙江路 1518 弄',
                        zip: 200333
                    }, {
                        date: '2016-05-07',
                        name: '王小虎',
                        province: '上海',
                        city: '普陀区',
                        address: '上海市普陀区金沙江路 1518 弄',
                        zip: 200333
                    }]

                }
            },
            methods: {

            }
        }
    </script>
@endsection