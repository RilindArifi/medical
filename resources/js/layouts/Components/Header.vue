<script setup>
import Notifications from "@/components/notifications.vue";
import { ref, onMounted, onBeforeUnmount } from "vue";
import { useAuthStore } from "@/stores/auth.js";
import useForm from "@/composables/form.js";
import VueAvatar from "@/components/VueAvatar.vue";
import Cookies from "js-cookie";
import { createI18n } from "vue-i18n";
import router from "@/router/index.js";

const isSidebarOpen = ref(false);
const isOpenBox = ref(false);
const sidebar = ref(false);

const authStore = useAuthStore(),
    { prepareRequest } = useForm({}),
    logout = async () => {
        await prepareRequest(() => authStore.logout());
    },
    onChangeLang = (lang) => {
        return Cookies.set("locale", lang);
    };

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
    document.documentElement.classList.toggle("mini-sidebar");
};

const toggleSidebarOne = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
    const sidebarOverlay = refs.sidebarOverlay;
    const mainWrapper = document.querySelector(".main-wrapper");

    if (isSidebarOpen.value) {
        sidebarOverlay.classList.add("opened");
        mainWrapper.classList.add("slide-nav");
    } else {
        sidebarOverlay.classList.remove("opened");
        mainWrapper.classList.remove("slide-nav", "open-msg-box");
    }

    document.documentElement.classList.toggle(
        "menu-opened",
        isSidebarOpen.value,
    );
};

const toggleOpenBox = () => {
    isOpenBox.value = !isOpenBox.value;
    const mainWrapper = document.querySelector(".main-wrapper");

    if (isOpenBox.value) {
        mainWrapper.classList.add("open-msg-box");
    } else {
        mainWrapper.classList.remove("open-msg-box");
    }
};

onMounted(() => {
    sidebar.value = document.querySelector(".sidebar"); // Retrieve sidebar after component mounted
    if (sidebar.value) {
        // Check if sidebar is not null
        sidebar.value.addEventListener("mouseenter", handleSidebarHover);
        sidebar.value.addEventListener("mouseleave", handleSidebarLeave);
    }
});

onBeforeUnmount(() => {
    if (sidebar.value) {
        // Check if sidebar is not null
        sidebar.value.removeEventListener("mouseenter", handleSidebarHover);
        sidebar.value.removeEventListener("mouseleave", handleSidebarLeave);
    }
});

const handleSidebarHover = () => {
    document.documentElement.classList.add("expand-menu");
};

const handleSidebarLeave = () => {
    document.documentElement.classList.remove("expand-menu");
};
</script>

<template>
    <div class="header">
        <div class="header-left">
            <router-link to="/dashboard" class="logo">
                <img
                    src="../../assets/img/logo.png"
                    width="35"
                    height="35"
                    alt=""
                />
                <span>Pre Clinic</span>
            </router-link>
        </div>
        <a id="toggle_btn" href="javascript:void(0);" @click="toggleSidebar"
            ><img src="../../assets/img/icons/bar-icon.svg" alt=""
        /></a>
        <a
            id="mobile_btn"
            @click="toggleSidebarOne"
            class="mobile_btn float-start"
            href="#sidebar"
            ><img src="../../assets/img/icons/bar-icon.svg" alt=""
        /></a>
        <div class="top-nav-search mob-view">
            <form>
                <input
                    type="text"
                    class="form-control"
                    placeholder="Search here"
                />
                <a class="btn"
                    ><img src="../../assets/img/icons/search-normal.svg" alt=""
                /></a>
            </form>
        </div>

        <ul class="nav user-menu float-end">
            <li class="nav-item dropdown d-none d-md-block">
                <a
                    href="javascript:;"
                    class="dropdown-toggle nav-link"
                    data-bs-toggle="dropdown"
                >
                    <span
                        v-if="$i18n.locale.includes('al')"
                        class="fi fi-al fis"
                        title="flag flag-al"
                        data-bs-toggle="tooltip"
                    ></span>
                    <span
                        v-else
                        class="fi fi-gb fis"
                        title="flag flag-gb"
                        data-bs-toggle="tooltip"
                    ></span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="drop-lang">
                        <ul class="notification-list d-flex align-items-center">
                            <li class="notification-message">
                                <a
                                    href="javascript:;"
                                    @click="
                                        onChangeLang('en');
                                        $i18n.locale = 'en';
                                    "
                                    v-if="$i18n.locale.includes('al')"
                                    ><span
                                        class="fi fi-gb fis"
                                        title="flag flag-gb"
                                        data-bs-toggle="tooltip"
                                    ></span>
                                    &nbsp;English</a
                                >
                                <a
                                    href="javascript:;"
                                    @click="
                                        onChangeLang('al');
                                        $i18n.locale = 'al';
                                    "
                                    v-else
                                    ><span
                                        class="fi fi-al fis"
                                        title="flag flag-al"
                                        data-bs-toggle="tooltip"
                                    ></span>
                                    &nbsp;Albania</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown d-none d-md-block">
                <a
                    href="javascript:;"
                    class="dropdown-toggle nav-link"
                    data-bs-toggle="dropdown"
                    ><img
                        src="../../assets/img/icons/note-icon-02.svg"
                        alt=""
                    /><span class="pulse"></span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span>Notifications</span>
                    </div>
                    <div class="drop-scroll">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media">
                                        <span class="avatar">
                                            <img
                                                alt="John Doe"
                                                src="../../assets/img/user.jpg"
                                                class="img-fluid"
                                            />
                                        </span>
                                        <div class="media-body">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >John Doe</span
                                                >
                                                added new task
                                                <span class="noti-title"
                                                    >Patient appointment
                                                    booking</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >4 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media">
                                        <span class="avatar">V</span>
                                        <div class="media-body">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >Tarah Shropshire</span
                                                >
                                                changed the task name
                                                <span class="noti-title"
                                                    >Appointment booking with
                                                    payment gateway</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >6 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media">
                                        <span class="avatar">L</span>
                                        <div class="media-body">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >Misty Tison</span
                                                >
                                                added
                                                <span class="noti-title"
                                                    >Domenic Houston</span
                                                >
                                                and
                                                <span class="noti-title"
                                                    >Claire Mapes</span
                                                >
                                                to project
                                                <span class="noti-title"
                                                    >Doctor available
                                                    module</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >8 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media">
                                        <span class="avatar">G</span>
                                        <div class="media-body">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >Rolland Webber</span
                                                >
                                                completed task
                                                <span class="noti-title"
                                                    >Patient and Doctor video
                                                    conferencing</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >12 mins ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                            <li class="notification-message">
                                <router-link to="/activities">
                                    <div class="media">
                                        <span class="avatar">V</span>
                                        <div class="media-body">
                                            <p class="noti-details">
                                                <span class="noti-title"
                                                    >Bernardo Galaviz</span
                                                >
                                                added new task
                                                <span class="noti-title"
                                                    >Private chat module</span
                                                >
                                            </p>
                                            <p class="noti-time">
                                                <span class="notification-time"
                                                    >2 days ago</span
                                                >
                                            </p>
                                        </div>
                                    </div>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <router-link to="/activities"
                            >View all Notifications</router-link
                        >
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown d-none d-md-block">
                <a
                    ref="openMsgBox"
                    href="javascript:void(0);"
                    id="open_msg_box"
                    @click="toggleOpenBox"
                    class="hasnotifications nav-link"
                >
                    <img
                        src="../../assets/img/icons/note-icon-01.svg"
                        alt=""
                    /><span class="pulse"></span>
                </a>
            </li>
            <li class="nav-item dropdown has-arrow user-profile-list">
                <a
                    href="javascript:;"
                    class="dropdown-toggle nav-link user-link"
                    data-bs-toggle="dropdown"
                >
                    <div class="user-names">
                        <h5>{{ authStore.user.name }}</h5>
                        <span v-for="role in authStore.user.role">
                            {{ role }}
                            <template v-if="authStore.user.role.length > 1">
                            </template>
                        </span>
                    </div>
                    <span class="user-img">
                        <vue-avatar :user="authStore.user" />
                    </span>
                </a>
                <div class="dropdown-menu">
                    <router-link class="dropdown-item" to="/profile"
                        >My Profile</router-link
                    >
                    <router-link class="dropdown-item" to="/edit-profile"
                        >Edit Profile</router-link
                    >
                    <router-link class="dropdown-item" to="/settings/settings"
                        >Settings</router-link
                    >
                    <button class="dropdown-item" @click="authStore.logout()">
                        Logout
                    </button>
                </div>
            </li>
            <li class="nav-item">
                <router-link to="/settings/settings" class="hasnotifications"
                    ><img
                        src="../../assets/img/icons/setting-icon-01.svg"
                        alt=""
                    />
                </router-link>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu float-end">
            <a
                href="javascript:;"
                class="dropdown-toggle"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                ><i class="fa-solid fa-ellipsis-vertical"></i
            ></a>
            <div class="dropdown-menu dropdown-menu-end">
                <router-link class="dropdown-item" to="/profile"
                    >My Profile</router-link
                >
                <router-link class="dropdown-item" to="/edit-profile"
                    >Edit Profile</router-link
                >
                <router-link class="dropdown-item" to="/settings/settings"
                    >Settings</router-link
                >
                <button
                    class="dropdown-item"
                    @click.prevent="authStore.logout()"
                >
                    Logout
                </button>
            </div>
        </div>
    </div>

    <notifications></notifications>

    <div
        ref="sidebarOverlay"
        class="sidebar-overlay"
        data-reff="#sidebar"
    ></div>
</template>
