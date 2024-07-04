export function buildFormData(values, method = null) {
    let formData = new FormData();

    if (method) {
        formData.append("_method", method);
    }
    const buildFormData = (formData, data, parentKey) => {
        if (
            data &&
            typeof data === "object" &&
            !(data instanceof Date) &&
            !(data instanceof File)
        ) {
            Object.keys(data).forEach((key) => {
                buildFormData(
                    formData,
                    data[key],
                    parentKey ? `${parentKey}[${key}]` : key,
                );
            });
        } else {
            const value = data == null ? "" : data;

            formData.append(parentKey, value);
        }
    };

    buildFormData(formData, values);

    return formData;
}
