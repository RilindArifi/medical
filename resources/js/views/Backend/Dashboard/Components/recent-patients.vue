<template>
    <table class="table mb-0 border-0 datatable custom-table">
        <thead>
            <tr>
                <th>
                    <div class="form-check check-tables">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value="something"
                        />
                    </div>
                </th>
                <th>No</th>
                <th>Patient name</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Diagnosis</th>
                <th>Triage</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in RecentPatients" :key="item.id">
                <td>
                    <div class="form-check check-tables">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value="something"
                        />
                    </div>
                </td>
                <td>{{ item.No }}</td>
                <td class="table-image">
                    <img
                        width="28"
                        height="28"
                        class="rounded-circle"
                        :src="`/src/assets/img/profiles/${item.Image}`"
                        alt=""
                    />
                    <h2>{{ item.Name }}</h2>
                </td>
                <td>{{ item.Age }}</td>
                <td>{{ item.DOB }}</td>
                <td>{{ item.Diagnosis }}</td>
                <td>
                    <button :class="item.Class">{{ item.Triage }}</button>
                </td>
                <td class="text-end">
                    <div class="dropdown dropdown-action">
                        <a
                            href="javascript:;"
                            class="action-icon dropdown-toggle"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            ><i class="fa fa-ellipsis-v"></i
                        ></a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <router-link
                                class="dropdown-item"
                                to="/patients/edit-patient"
                                ><i class="fa-solid fa-pen-to-square m-r-5"></i>
                                Edit</router-link
                            >
                            <a class="dropdown-item" href="javascript:;"
                                ><i class="fa fa-trash-alt m-r-5"></i> Delete</a
                            >
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import RecentPatients from "@/assets/json/recent-patients.json";
export default {
    data() {
        return {
            RecentPatients: RecentPatients,
        };
    },
};
</script>
