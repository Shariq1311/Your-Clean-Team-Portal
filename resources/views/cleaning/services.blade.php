<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Services</title>
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;

            margin: 24px < !doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Services</title><link href="{{ asset('mc-styles/Your Clean Team/css/app.css') }}" rel="stylesheet" /><link href="{{ asset('css/app.css') }}" rel="stylesheet" />@do_action('Your Clean Team_header') </head><body class="Your Clean Team__menuLeft--dark Your Clean Team__topbar--fixed Your Clean Team__menuLeft--unfixed"><div class="Your Clean Team__layout Your Clean Team__layout--hasSider"><div class="Your Clean Team__layout"><div class="Your Clean Team__layout__content" style="padding:24px;"><h1 class="font-weight-bold">Cleaning Services</h1><div class="mb-3"><input id="q" placeholder="Search services..." class="form-control" style="max-width:420px;display:inline-block" /><select id="category" class="form-select" style="width:220px;display:inline-block;margin-left:12px"><option value="">All categories</option></select></div><div id="content">Loading services…</div></div></div></div><script>(async function() {
                    const content=document.getElementById('content');
                    const qInput=document.getElementById('q');
                    const categorySelect=document.getElementById('category');

                    async function load() {
                        content.textContent='Loading services…';

                        try {
                            const res=await fetch('/api/v1/cleaning/frontend/services');
                            if( !res.ok) throw new Error(res.status + ' ' + res.statusText);
                            const services=await res.json();
                            render(services);
                        }

                        catch(e) {
                            content.textContent='Failed to load services: ' + e.message;
                        }
                    }

                    function groupByCategory(list) {
                        const map= {}

                        ;

                        list.forEach(s=> {
                                const cat=s.category || 'Uncategorized';
                                if( !map[cat]) map[cat]=[];
                                map[cat].push(s);
                            });
                        return map;
                    }

                    function render(services) {
                        const cats=Array.from(new Set(services.map(s=> s.category || 'Uncategorized'))).sort();

                        categorySelect.innerHTML='<option value="">All categories</option>' + cats.map(c=>`<option value="${escapeHtml(c)}" >$ {
                                escapeHtml(c)
                            }

                            </option>`).join('');

                        function filterList() {
                            const q=qInput.value.trim().toLowerCase();
                            const cat=categorySelect.value;
                            let list=services;
                            if(cat) list=list.filter(s=> (s.category || 'Uncategorized')===cat);
                            if(q) list=list.filter(s=> (s.name||'').toLowerCase().includes(q) || (s.description||'').toLowerCase().includes(q));
                            const grouped=groupByCategory(list);
                            content.innerHTML='';

                            if(list.length===0) {
                                content.textContent='No services found.'; return
                            }

                            for(const [catName, items] of Object.entries(grouped)) {
                                const wrap=document.createElement('div');
                                wrap.className='mb-4';
                                const h=document.createElement('h4'); h.textContent=catName + ' (' +items.length+')'; wrap.appendChild(h);

                                items.forEach(s=> {
                                        const el=document.createElement('div'); el.className='card mb-2 p-2';
                                        const title=document.createElement('div'); title.innerHTML='<strong>' +escapeHtml(s.name||'')+'</strong>'; el.appendChild(title);

                                        if(s.description) {
                                            const d=document.createElement('div'); d.textContent=s.description; el.appendChild(d);
                                        }

                                        const meta=document.createElement('div'); meta.className='text-muted small'; meta.textContent=(s.url? 'URL: ' + s.url + ' • ' : '') + (s.slug? 'slug: ' + s.slug : ''); el.appendChild(meta);
                                        wrap.appendChild(el);
                                    });
                                content.appendChild(wrap);
                            }
                        }

                        qInput.addEventListener('input', debounce(filterList, 180));
                        categorySelect.addEventListener('change', filterList);
                        filterList();
                    }

                    function escapeHtml(s) {
                        return String(s).replace(/[&<>\"']/g, c => ({' &':' &amp; ',' <':' &lt; ',' >':' &gt; ',' \"':' &quot; ',"' ":'&#39;'}[c])); }
 function debounce(fn, t) {
                                let id; return (...a)=> {
                                    clearTimeout(id); id=setTimeout(()=>fn(...a), t);
                                }

                                ;
                            }

                            load();
                        })();
                    </script> @do_action('Your Clean Team_footer') </body> </html> title.innerHTML='<strong>' + escapeHtml(s.name || '') + '</strong>';
                    el.appendChild(title);

                    if (s.description) {
                        const d=document.createElement('div');
                        d.textContent=s.description;
                        el.appendChild(d);
                    }

                    const meta=document.createElement('div');
                    meta.className='meta';
                    meta.textContent=(s.url ? 'URL: ' + s.url + ' • ' : '') + (s.slug ? 'slug: ' + s.slug : '');
                    el.appendChild(meta);
                    wrap.appendChild(el);
                });
            content.appendChild(wrap);
        }
        }

        qInput.addEventListener('input', debounce(filterList, 180));
        categorySelect.addEventListener('change', filterList);
        filterList();
        }

        function escapeHtml(s) {
            return String(s).replace(/[&<>"']/g, c => ({
 '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            }

            [c]));
        }

        function debounce(fn, t) {
            let id;

            return (...a)=> {
                clearTimeout(id);
                id=setTimeout(()=> fn(...a), t);
            }

            ;
        }

        load();
        })();
        </script></body></html>