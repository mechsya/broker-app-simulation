class Api {
    get(params) {}

    post(params) {
        fetch(params.url, {
            method: "POST",
            headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
            },
            body: JSON.stringify(params.body),
        })
            .then(async (response) => params.success(await response.json()))
            .catch((e) => params.error(e));
    }
}

const api = new Api();
