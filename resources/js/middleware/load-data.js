import {useSettingsStore} from "@/stores/settings.js";
import {useAuthStore} from "@/stores/auth.js";

export default async () => {
    await useAuthStore().fetchUser();
    await useSettingsStore().loadSettings()
}