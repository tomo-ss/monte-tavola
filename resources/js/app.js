import './bootstrap';

import flatpickr from "flatpickr";
import { Japanese } from "flatpickr/dist/l10n/ja";
import "flatpickr/dist/flatpickr.css";

/**
 * フェードイン（既存）
 */
document.addEventListener("DOMContentLoaded", () => {
    const targets = document.querySelectorAll(".fade-up");

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("show");
            }
        });
    }, {
        threshold: 0.2
    });

    targets.forEach(el => observer.observe(el));
});

/**
 * 予約フォーム：カレンダー + 時間制御
 */
document.addEventListener("DOMContentLoaded", async () => {
    const dateInput = document.getElementById("reservation_date");
    const timeSelect = document.getElementById("time");

    // 予約ページ以外では何もしない
    if (!dateInput || !timeSelect) return;

    // Bladeから渡された予約済み時間
    const reservedTimes = window.reservedTimes ?? {};

    // 休業日取得
    const res = await fetch("/api/holidays");
    const holidays = await res.json();

    // flatpickr 初期化
    flatpickr(dateInput, {
        locale: Japanese,
        dateFormat: "Y-m-d",
        minDate: "today",
        disable: holidays,

        onChange: (_, dateStr) => {
            timeSelect.disabled = false;

            const reserved = reservedTimes[dateStr] ?? [];

            [...timeSelect.options].forEach(option => {
                if (!option.value) return;
                option.disabled = reserved.includes(option.value);
            });
        },
    });

    // バリデーションエラーで戻ったときも反映
    if (dateInput.value) {
        dateInput.dispatchEvent(new Event("change"));
    }
});
