@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <h4>Thiết lập quyền cho người dùng: {{ $user->ten }}</h4>
        <form action="{{ route('assignUserPermissions', $user->id) }}" method="POST">
            @csrf

            {{-- Quyền quản lý người dùng --}}
            <h5>Quyền quản lý người dùng</h5>
            <div class="form-group">
                <label for="can_create_user">Quyền tạo người dùng:</label>
                <select name="can_create_user" id="can_create_user" class="form-control">
                    <option value="1" {{ ($user->actions->can_create_user ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_create_user ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            <div class="form-group">
                <label for="can_edit_user">Quyền sửa người dùng:</label>
                <select name="can_edit_user" id="can_edit_user" class="form-control">
                    <option value="1" {{ ($user->actions->can_edit_user ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_edit_user ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            <div class="form-group">
                <label for="can_delete_user">Quyền xóa người dùng:</label>
                <select name="can_delete_user" id="can_delete_user" class="form-control">
                    <option value="1" {{ ($user->actions->can_delete_user ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_delete_user ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            {{-- Quyền quản lý thiết bị --}}
            <h5>Quyền quản lý thiết bị</h5>
            <div class="form-group">
                <label for="can_create_device">Quyền tạo thiết bị:</label>
                <select name="can_create_device" id="can_create_device" class="form-control">
                    <option value="1" {{ ($user->actions->can_create_device ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_create_device ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            <div class="form-group">
                <label for="can_edit_device">Quyền sửa thiết bị:</label>
                <select name="can_edit_device" id="can_edit_device" class="form-control">
                    <option value="1" {{ ($user->actions->can_edit_device ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_edit_device ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            <div class="form-group">
                <label for="can_delete_device">Quyền xóa thiết bị:</label>
                <select name="can_delete_device" id="can_delete_device" class="form-control">
                    <option value="1" {{ ($user->actions->can_delete_device ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_delete_device ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            {{-- Quyền quản lý lịch bảo trì --}}
            <h5>Quyền quản lý lịch bảo trì</h5>
            <div class="form-group">
                <label for="can_create_schedule">Quyền tạo lịch bảo trì:</label>
                <select name="can_create_schedule" id="can_create_schedule" class="form-control">
                    <option value="1" {{ ($user->actions->can_create_schedule ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_create_schedule ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            <div class="form-group">
                <label for="can_edit_schedule">Quyền sửa lịch bảo trì:</label>
                <select name="can_edit_schedule" id="can_edit_schedule" class="form-control">
                    <option value="1" {{ ($user->actions->can_edit_schedule ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_edit_schedule ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            <div class="form-group">
                <label for="can_delete_schedule">Quyền xóa lịch bảo trì:</label>
                <select name="can_delete_schedule" id="can_delete_schedule" class="form-control">
                    <option value="1" {{ ($user->actions->can_delete_schedule ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_delete_schedule ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            {{-- Quyền quản lý thông báo --}}
            <h5>Quyền quản lý thông báo</h5>
            <div class="form-group">
                <label for="can_create_notification">Quyền tạo thông báo:</label>
                <select name="can_create_notification" id="can_create_notification" class="form-control">
                    <option value="1" {{ ($user->actions->can_create_notification ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_create_notification ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            {{-- Quyền quản lý báo cáo --}}
            <h5>Quyền tạo báo cáo</h5>
            <div class="form-group">
                <label for="can_create_report">Quyền tạo báo cáo:</label>
                <select name="can_create_report" id="can_create_report" class="form-control">
                    <option value="1" {{ ($user->actions->can_create_report ?? 0) ? 'selected' : '' }}>Được phép</option>
                    <option value="0" {{ !($user->actions->can_create_report ?? 0) ? 'selected' : '' }}>Không được phép</option>
                </select>
            </div>

            {{-- Nút Lưu --}}
            <button type="submit" class="btn btn-primary">Lưu quyền</button>
        </form>
    </div>
@endsection
