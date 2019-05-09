@extends('layouts.admin-layout')

@section('content')

    <div class="row" style="margin-top:2em;">
        <h5 class="center" style="font-weight: bolder">Operations Manager - Dashboard</h5>
        <div class="col s12 m4">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title" style="font-weight: bolder">Users</span>
                    <p style="font-weight: bolder">{{'Total Users - '.count($users)}}</p>
                    <table>
                        <thead>
                        <tr>
                            <th>Agents</th>
                            <th>Clients</th>
                            <th>Undertakers</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{count($users)}}</td>
                            <td>15 000</td>
                            <td>2</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-action">
                    <a href="{{url('users')}}">View Users</a>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title" style="font-weight: bolder">Policies</span>
                    <p style="font-weight: bolder">{{'Total Policies - '}}</p>
                    <table>
                        <thead>
                        <tr>
                            <th>Plan A</th>
                            <th>Plan B</th>
                            <th>Plan C</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-action">
                    <a href="#">Policies</a>
                </div>
            </div>
        </div>
        <div class="col s12 m4">
            <div class="card blue-grey darken-1">
                <div class="card-content white-text">
                    <span class="card-title" style="font-weight: bolder">Fleet Management</span>
                    <p style="font-weight: bolder">{{'Total Fleet - '}}</p>
                    <table>
                        <thead>
                        <tr>
                            <th>Hearse</th>
                            <th>Admin</th>
                            <th>Agent</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-action">
                    <a href="#">View Fleet</a>
                </div>
            </div>
        </div>
    </div>

@endsection
