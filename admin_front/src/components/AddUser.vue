<template>
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModal" aria-hidden="true">
        <form @submit.prevent="addUser" action="" method="post">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModal">Thêm User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input v-model="form.name" name="name" type="text" class="form-control"
                                placeholder="Nhập họ và tên">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input v-model="form.email" name="email" type="text" class="form-control"
                                placeholder="Nhập email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mật khẩu</label>
                            <input v-model="form.password" name="password" type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Xác nhận</label>
                            <input v-model="form.confirm" name="confirm" type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nhóm</label>
                            <select v-model="form.group_role" name="group_role" class="form-control">
                                <option value="">--- Nhóm ---</option>
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                <option value="Reviewer">Reviewer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input v-model="form.is_active" name="is_active" type="checkbox" value="1">
                            <label class="form-label"> Đang hoạt động</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="clearForm" type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import iziToast from 'izitoast'

const form = ref({
    name: '',
    email: '',
    password: '',
    confirm: '',
    group_role: '',
    is_active: null
})

const token = localStorage.getItem('access_token');

const addUser = async () => {
    if (token) {
        if (form.value.password == form.value.confirm && form.value.password != '') {
            try {
                const response = await axios({
                    method: 'POST',
                    url: 'http://adminrivercrane.test/api/crud/user/store',
                    headers: { Authorization: `Bearer ${token}` },
                    data: form.value
                });
                if (response.data.success) {
                    form.value = { ...form }
                    iziToast.success({
                        title: '',
                        position: 'topRight',
                        message: 'Thêm mới thành công'
                    })
                }
            } catch (error) {
                // In ra từng lỗi validation
                for (const field in error.response.data.errors) {
                    error.response.data.errors[field].forEach(error => {
                        iziToast.error({
                            title: '',
                            position: 'topRight',
                            message: error
                        });
                    });
                }
            }
        } else {
            iziToast.error({
                title: '',
                position: 'topRight',
                message: 'Mật khẩu bỏ trống hoặc xác nhận mật khẩu sai'
            })
        }
    }
}

const clearForm = () => {
    form.value = { ...form }
}
</script>

<style lang="scss" scoped></style>