import axiosClient from "@/axios.js";

export default function useModelOperations(model) {
    const fetchData = (state) => {
            return axiosClient.post(model, state);
        },
        fetchSingle = (id) => {
            return axiosClient.get(`${model}/${id}/edit`);
        },
        storeAction = (state) => {
            return axiosClient.post(`${model}/store`, state);
        },
        updateAction = (id, state) => {
            return axiosClient.put(`${model}/${id}/update`, state);
        },
        deleteAction = (id) => {
            return axiosClient.delete(`${model}/${id}/delete`);
        },
        restoreAction = (id) => {
            return axiosClient.post(`${model}/${id}/restore`);
        },
        forceDeleteAction = (id) => {
            return axiosClient.delete(`${model}/${id}/force-delete`);
        },
        enableAction = (id) => {
            return axiosClient.put(`${model}/${id}/enabled`);
        },
        disableAction = (id) => {
            return axiosClient.put(`${model}/${id}/disabled`);
        },
        remoteModel = async (query, params = {}) => {
            const { data } = await axiosClient.get(`${model}/dropdown`, {
                params: { search: query, ...params },
            });
            let collect = [];
            data.data.forEach((item) => {
                collect.push({
                    value: item.id,
                    label: item.name,
                });
            });

            return collect;
        };

    return {
        fetchData,
        fetchSingle,
        storeAction,
        updateAction,
        deleteAction,
        restoreAction,
        forceDeleteAction,
        remoteModel,
        enableAction,
        disableAction,
    };
}
