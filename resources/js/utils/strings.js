import {ref} from "vue";
import dayjs from "dayjs";
import {useSettingsStore} from "@/stores/settings.js";


const handleDateFormat = (value, defaultValue) => {
    if (typeof value === 'string' && value.includes('|')) {
        const array = value.split('|');
        return array[1];
    }
    return value || defaultValue;
}

export const dateFormat = () => {
    return handleDateFormat('Y-m-d|YYYY-MM-DD');
}

export const timeFormat = () => {
    return handleDateFormat('H:i|HH:mm');
}

export const rangePresets = [
    {
        label: 'Last 7 Days',
        value: [dayjs().subtract(7, 'd'), dayjs()],
    },
    {
        label: 'Last 14 Days',
        value: [dayjs().subtract(14, 'd'), dayjs()],
    },
    {
        label: 'Last 30 Days',
        value: [dayjs().subtract(30, 'd'), dayjs()],
    },
    {
        label: 'Last 90 Days',
        value: [dayjs().subtract(90, 'd'), dayjs()],
    },
];