document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("createRecipeForm");
    if (!form) return;

    // --- Load stored values ---
    form.querySelectorAll("input, textarea, select").forEach(el => {
        if (el.type === "file") return;

        // Handle grouped checkboxes uniquely
        let key = "persist_" + el.name;
        if (el.type === "checkbox" && el.name.endsWith("[]")) {
            key = "persist_" + el.name + "_" + el.value;
        }

        const saved = localStorage.getItem(key);

        if (saved !== null) {
            if (el.type === "checkbox" || el.type === "radio") {
                el.checked = saved === "true";
            } else {
                el.value = saved;
            }
        }

        // --- Save values ---
        const eventType = el.type === "checkbox" ? "change" : "input";
        el.addEventListener(eventType, () => {
            let key = "persist_" + el.name;
            if (el.type === "checkbox" && el.name.endsWith("[]")) {
                key = "persist_" + el.name + "_" + el.value;
            }
            localStorage.setItem(key, el.type === "checkbox" ? el.checked : el.value);
        });
    });

    // --- Clear values ---
    const clearBtn = document.getElementById("btnClear");
    if (clearBtn) {
        clearBtn.addEventListener("click", () => {
            form.querySelectorAll("input, textarea, select").forEach(el => {
                let key = "persist_" + el.name;
                if (el.type === "checkbox" && el.name.endsWith("[]")) {
                    key = "persist_" + el.name + "_" + el.value;
                }

                localStorage.removeItem(key);

                if (el.type === "file") {
                    el.value = "";
                } else if (el.type === "checkbox") {
                    el.checked = false;
                } else if (el.tagName === "SELECT") {
                    el.selectedIndex = 0;
                } else {
                    el.value = "";
                }
            });

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "btnClear";
            input.value = "Clear";
            form.appendChild(input);
            form.submit();
        });
    }

    // --- Clear after submit ---
    form.addEventListener("submit", () => {
        form.querySelectorAll("input, textarea, select").forEach(el => {
            if (el.type === "file") return;

            let key = "persist_" + el.name;
            if (el.type === "checkbox" && el.name.endsWith("[]")) {
                key = "persist_" + el.name + "_" + el.value;
            }

            localStorage.removeItem(key);
        });
    });
});
