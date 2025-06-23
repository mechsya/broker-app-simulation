function exportData(model, type, event) {
    const csrf = event.currentTarget.dataset.csrf;

    fetch("/export", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
        },
        body: JSON.stringify({ model, type }),
    }).then(async (response) => {
        if (!response.ok) {
            alert("Gagal export data");
            return;
        }

        if (response.status === 204) {
            alert("No data to export");
            return;
        }

        const blob = await response.blob();
        const filename = `${model}.${type === "excel" ? "xlsx" : type}`;
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = filename;
        link.click();
    });
}
