eval((function(a) {
    var c = [];
    for (var b = 1; b < 128; b++) c[b] = String.fromCharCode(b);
    var d = [11, 12, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
    var e = [];
    for (var b = 0; b < d.length; b++) e[d[b]] = b + 1;
    var f = a.split('\x01');
    for (var g = f.length - 1; g >= 0; g--) {
        var h = null;
        var i = f[g];
        var j = null;
        var k = 0;
        var l = i.length;
        var m;
        for (var n = 0; n < l; n++) {
            var o = i.charCodeAt(n);
            if (o > 31) continue;
            var p = e[o];
            if (p) {
                p = p - 1;
                h = p * 113 + i.charCodeAt(n + 1) - 14;
                m = n;
                n++;
            } else if (o == 6) {
                h = 113 * d.length + (i.charCodeAt(n + 1) - 14) * 113 + i.charCodeAt(n + 2) - 14;
                m = n;
                n += 2;
            } else {
                continue;
            }
            if (j == null) j = [];
            if (m > k) j.push(i.substring(k, m));
            j.push(f[h + 1]);
            k = n + 1;
        }
        if (j != null) {
            if (k < l) j.push(i.substring(k));
            f[g] = j.join('');
        }
    }
    a = f[0].split('\x08').join('\'').split('\x07').join('\\');
    var x = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    var y = [1, 2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31];
    for (var b = 0; b < y.length; b++) a = a.split('\x7F' + x.charAt(b)).join(c[y[b]]);
    return a.split('\x7F!').join('\x7F');
})
