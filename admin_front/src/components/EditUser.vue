<template>
    <div class="modal fade" :id="'editUserModal_' + user.id" tabindex="-1" :aria-labelledby="'editUserModal_' + user.id"
        aria-hidden="true">
        <form @submit.prevent="updateUser(user.id)">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chỉnh sửa User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input v-model="user.name" type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input v-model="user.email" type="text" class="form-control">
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
                            <select v-model="user.group_role" class="form-control">
                                <option value="Admin">Admin</option>
                                <option value="Editor">Editor</option>
                                <option value="Reviewer">Reviewer</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="clearForm" type="button" class="btn btn-danger" data-bs-dismiss="modal">Hủy</button>
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

const token = localStorage.getItem('access_token');
const props = defineProps({
    user: {
        type: Object,
        required: true,
    }
})

const form = ref({
    name: '',
    email: '',
    password: '',
    confirm: '',
    group_role: '',
})

const updateUser = async (userId) => {
    form.value.name = props.user.name
    form.value.email = props.user.email
    form.value.group_role = props.user.group_role
    if (form.value.password == form.value.confirm) {
        try {
            const response = await axios({
                method: 'PUT',
                url: `http://adminrivercrane.test/api/crud/user/update/${userId}`,
                headers: { Authorization: `Bearer ${token}` },
                data: form.value
            });
            iziToast.success({
                title: '',
                position: 'topRight',
                message: 'Cập nhật thành công'
            })
            form.value = {...form}
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
            message: 'Xác nhận mật khẩu không trùng khớp'
        })
    }
}

const clearForm = () => {
    form.value = {...form}
}
</script>

<style lang="scss" scoped></style>