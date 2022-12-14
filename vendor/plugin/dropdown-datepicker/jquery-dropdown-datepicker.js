/*
 *  jQuery Dropdown Datepicker - v1.3.0
 *  A simple customizable jquery dropdown datepicker
 *
 *  Made by Md Shafkat Hussain Tanvir
 *  Under ISC License
 */
! function(f, e, u, t) {
    "use strict";
    var n = "dropdownDatepicker",
        a = { defaultDate: null, defaultDateFormat: "yyyy-mm-dd", displayFormat: "dmy", submitFormat: "yyyy-mm-dd", minYear: null, maxYear: null, allowPast: !0, submitFieldName: "date", wrapperClass: "date-dropdowns", dropdownClass: null, daySuffixes: !0, monthSuffixes: !0, monthFormat: "long", required: !1, dayLabel: "Day", monthLabel: "Month", yearLabel: "Year", monthLongValues: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"], monthShortValues: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], initialDayMonthYearValues: ["Day", "Month", "Year"], daySuffixValues: ["st", "nd", "rd", "th"] };

    function r(e, t) { return this.element = e, this.$element = f(e), this.config = f.extend({}, a, t), this.internals = { objectRefs: {} }, this.init(), this } f.extend(r.prototype, {
        init: function() {
            if (this.setInternalVariables(), this.setupMarkup(), this.buildDropdowns(), this.attachDropdowns(), this.bindChangeEvent(), this.config.defaultDate) {
                if (!this.config.allowPast && (new Date).getTime() > new Date(this.config.defaultDate).getTime()) return;
                this.populateDefaultDate()
            }
        },
        setInternalVariables: function() {
            var e = new Date;
            this.internals.currentDay = e.getDate(), this.internals.currentMonth = e.getMonth() + 1, this.internals.currentYear = e.getFullYear()
        },
        setupMarkup: function() {
            var e, t;
            if ("input" === this.element.tagName.toLowerCase()) {
                this.config.defaultDate || (this.config.defaultDate = this.element.value), t = this.$element.attr("type", "hidden").wrap('<div class="' + this.config.wrapperClass + '">  </div>');
                var i = this.config.submitFieldName !== a.submitFieldName;
                this.element.hasAttribute("name") || i ? i && this.$element.attr("name", this.config.submitFieldName) : this.$element.attr("name", a.submitFieldName), e = this.$element.parent()
            } else t = f("<input/>", { type: "hidden", name: this.config.submitFieldName }), this.$element.append(t).addClass(this.config.wrapperClass), e = this.$element;
            return this.internals.objectRefs.pluginWrapper = e, this.internals.objectRefs.hiddenField = t, !0
        },
        buildDropdowns: function() { var e, t, i, n, a, s; return r.message = { day: this.config.initialDayMonthYearValues[0], month: this.config.initialDayMonthYearValues[1], year: this.config.initialDayMonthYearValues[2] }, e = this.buildBaseDropdown("day"), t = this.buildDayOptions(), e = this.addOptionsToDropdown(e, t), this.internals.objectRefs.dayDropdown = e, i = this.buildBaseDropdown("month"), n = this.buildMonthOptions(), i = this.addOptionsToDropdown(i, n), this.internals.objectRefs.monthDropdown = i, a = this.buildBaseDropdown("year"), s = this.buildYearOptions(), a = this.addOptionsToDropdown(a, s), this.internals.objectRefs.yearDropdown = a, !0 },
        attachDropdowns: function() {
            var e = this.internals.objectRefs.pluginWrapper,
                t = this.internals.objectRefs.dayDropdown,
                i = this.internals.objectRefs.monthDropdown,
                n = this.internals.objectRefs.yearDropdown;
            switch (this.config.displayFormat) {
                case "mdy":
                    e.append(i, t, n);
                    break;
                case "ymd":
                    e.append(n, i, t);
                    break;
                case "dmy":
                default:
                    e.append(t, i, n)
            }
            return !0
        },
        bindChangeEvent: function() {
            var l = this.internals.objectRefs.dayDropdown,
                h = this.internals.objectRefs.monthDropdown,
                d = this.internals.objectRefs.yearDropdown,
                u = this,
                c = this.internals.objectRefs,
                p = this;
            c.pluginWrapper.on("change", "select", function() {
                var e, t, i, n, a, s = l.val(),
                    r = h.val(),
                    o = d.val();
                f(this).hasClass("year") && (p.clearOptions(h), t = p.buildMonthOptions(o), i = p.addOptionsToDropdown(h, t), p.internals.objectRefs.monthDropdown = i, r = null, p.clearOptions(l), n = p.buildDayOptions(r, o), a = p.addOptionsToDropdown(l, n), p.internals.objectRefs.dayDropdown = a), f(this).hasClass("month") && (p.clearOptions(l), n = p.buildDayOptions(r, o), a = p.addOptionsToDropdown(l, n), p.internals.objectRefs.dayDropdown = a), c.hiddenField.val(""), s * r * o != 0 && (e = u.formatSubmitDate(s, r, o), c.hiddenField.val(e)), c.hiddenField.change()
            })
        },
        buildBaseDropdown: function(e) { var t = e; return this.config.dropdownClass && (t += " " + this.config.dropdownClass), f("<select></select>", { class: t, name: this.config.submitFieldName + "_[" + e + "]", required: this.config.required }) },
        buildDayOptions: function(e, t) {
            var i, n = 1,
                a = 10,
                s = 31,
                r = [],
                o = u.createElement("option");
            !this.config.allowPast && t === this.internals.currentYear && e === this.internals.currentMonth && n < this.internals.currentDay && (n = this.internals.currentDay), a < n && (a = n);
            var l = new Date(t, e, 0).getDate();
            l < s && (s = l), this.config.dayLabel && (o.setAttribute("value", ""), o.appendChild(u.createTextNode(this.config.dayLabel)), r.push(o));
            for (var h = n; h <= 9; h++) i = this.config.daySuffixes ? h + this.getSuffix(h) : "0" + h, (o = u.createElement("option")).setAttribute("value", "0" + h), o.appendChild(u.createTextNode(i)), r.push(o);
            for (var d = a; d <= s; d++) i = d, this.config.daySuffixes && (i = d + this.getSuffix(d)), (o = u.createElement("option")).setAttribute("value", d), o.appendChild(u.createTextNode(i)), r.push(o);
            return r
        },
        buildMonthOptions: function(e) {
            var t = 1,
                i = [],
                n = u.createElement("option");
            this.config.allowPast || e !== this.internals.currentYear || (t = this.internals.currentMonth), this.config.monthLabel && (n.setAttribute("value", ""), n.appendChild(u.createTextNode(this.config.monthLabel)), i.push(n));
            for (var a = t; a <= 12; a++) {
                var s;
                switch (this.config.monthFormat) {
                    case "short":
                        s = this.config.monthShortValues[a - 1];
                        break;
                    case "long":
                        s = this.config.monthLongValues[a - 1];
                        break;
                    case "numeric":
                        s = a, this.config.monthSuffixes && (s += this.getSuffix(a))
                }
                a < 10 && (a = "0" + a), (n = u.createElement("option")).setAttribute("value", a), n.appendChild(u.createTextNode(s)), i.push(n)
            }
            return i
        },
        buildYearOptions: function() {
            var e = this.config.minYear,
                t = this.config.maxYear,
                i = [],
                n = u.createElement("option");
            this.config.yearLabel && (n.setAttribute("value", ""), n.appendChild(u.createTextNode(this.config.yearLabel)), i.push(n)), e || (e = this.config.allowPast ? 1970 : this.internals.currentYear), t || (t = this.internals.currentYear);
            for (var a = t; e <= a; a--)(n = u.createElement("option")).setAttribute("value", a), n.appendChild(u.createTextNode(a)), i.push(n);
            return i
        },
        addOptionsToDropdown: function(e, t) { for (var i = 0; i < t.length; i++) e.append(t[i]); return e },
        clearOptions: function(e) { e.children("option").each(function() { f(this).remove() }) },
        populateDefaultDate: function() {
            var e = this.config.defaultDate,
                t = [],
                i = "",
                n = "",
                a = "";
            switch (this.config.defaultDateFormat) {
                case "yyyy-mm-dd":
                default:
                    i = (t = e.split("-"))[2], n = t[1], a = t[0];
                    break;
                case "dd/mm/yyyy":
                    i = (t = e.split("/"))[0], n = t[1], a = t[2];
                    break;
                case "mm/dd/yyyy":
                    i = (t = e.split("/"))[1], n = t[0], a = t[2];
                    break;
                case "unix":
                    (t = new Date).setTime(1e3 * e), i = t.getDate() + "", n = t.getMonth() + 1 + "", a = t.getFullYear(), i.length < 2 && (i = "0" + i), n.length < 2 && (n = "0" + n)
            }
            return this.internals.objectRefs.dayDropdown.val(i), this.internals.objectRefs.monthDropdown.val(n), this.internals.objectRefs.yearDropdown.val(a), this.internals.objectRefs.hiddenField.val(e), !0 === this.checkDate(i, n, a) && this.internals.objectRefs.dayDropdown.addClass("invalid"), !0
        },
        getSuffix: function(e) {
            var t = "",
                i = this.config.daySuffixValues[0],
                n = this.config.daySuffixValues[1],
                a = this.config.daySuffixValues[2],
                s = this.config.daySuffixValues[3];
            switch (e % 10) {
                case 1:
                    t = e % 100 == 11 ? s : i;
                    break;
                case 2:
                    t = e % 100 == 12 ? s : n;
                    break;
                case 3:
                    t = e % 100 == 13 ? s : a;
                    break;
                default:
                    t = s
            }
            return t
        },
        formatSubmitDate: function(e, t, i) {
            var n, a;
            switch (this.config.submitFormat) {
                case "unix":
                    (a = new Date).setDate(e), a.setMonth(t - 1), a.setYear(i), n = Math.round(a.getTime() / 1e3);
                    break;
                default:
                    n = this.config.submitFormat.replace("dd", e).replace("mm", t).replace("yyyy", i)
            }
            return n
        },
        destroy: function() {
            var e = this.config.wrapperClass;
            if (this.$element.hasClass(e)) this.$element.empty();
            else {
                var t = this.$element.parent().find("select");
                this.$element.unwrap(), t.remove()
            }
        }
    }), f.fn[n] = function(i) {
        return this.each(function() {
            if ("string" == typeof i) {
                var e = Array.prototype.slice.call(arguments, 1),
                    t = f.data(this, "plugin_" + n);
                if (void 0 === t) return f.error("Please initialize the plugin before calling this method."), !1;
                t[i].apply(t, e)
            } else f.data(this, "plugin_" + n) || f.data(this, "plugin_" + n, new(this, i))
        }), this
    }
}(jQuery, window, document);