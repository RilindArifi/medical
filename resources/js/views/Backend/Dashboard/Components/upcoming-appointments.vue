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
                <th>Doctor</th>
                <th>Time</th>
                <th>Disease</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in UpcomingAppointments" :key="item.id">
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
                <td>{{ item.Name }}</td>
                <td class="table-image appoint-doctor">
                    <img
                        width="28"
                        height="28"
                        class="rounded-circle"
                        :src="`/src/assets/img/profiles/${item.Image}`"
                        alt=""
                    />
                    <h2>{{ item.Doctor }}</h2>
                </td>
                <td class="appoint-time">
                    <span>{{ item.Date }}</span
                    >{{ item.Time }}
                </td>
                <td>
                    <button class="custom-badge status-green">Fracture</button>
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
                                to="/appointments/edit-appointment"
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
import UpcomingAppointments from "@/assets/json/upcoming-appointments.json";
export default {
    data() {
        return {
            UpcomingAppointments: UpcomingAppointments,
        };
    },
};
</script>
