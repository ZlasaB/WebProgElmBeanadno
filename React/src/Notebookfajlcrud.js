import React, { useState, useEffect } from 'react';

const NotebookFajlCrud = () => {
    const [gepek, setGepek] = useState([]);
    const [form, setForm] = useState({ gyarto: '', tipus: '', kijelzo: '15.6', memoria: '8192', merevlemez: '512', videovezerlo: 'Integrált', ar: '' });

    const API_URL = 'http://localhost/notebook_projekt/fajl_api.php';

    const listaz = () => {
        fetch(API_URL)
            .then(res => res.json())
            .then(data => setGepek(data));
    };

    useEffect(() => { listaz(); }, []);

    const mentes = (e) => {
        e.preventDefault();
        const fd = new FormData();
        Object.keys(form).forEach(key => fd.append(key, form[key]));

        fetch(API_URL, { method: 'POST', body: fd })
            .then(res => res.json())
            .then(valasz => {
                alert(valasz.status);
                listaz(); 
            });
    };

    return (
        <div style={{ padding: '20px', background: '#eee' }}>
            <h3>React CRUD - Mentés a gep.txt fájlba</h3>
            <form onSubmit={mentes} style={{ display: 'flex', gap: '5px', marginBottom: '20px' }}>
                <input placeholder="Gyártó" onChange={e => setForm({...form, gyarto: e.target.value})} required />
                <input placeholder="Típus" onChange={e => setForm({...form, tipus: e.target.value})} required />
                <input placeholder="Ár" type="number" onChange={e => setForm({...form, ar: e.target.value})} required />
                <button type="submit">Hozzáadás</button>
            </form>

            <table border="1" style={{ width: '100%', background: 'white' }}>
                <thead>
                    <tr><th>Gyártó</th><th>Típus</th><th>Ár</th></tr>
                </thead>
                <tbody>
                    {gepek.map((g, i) => (
                        <tr key={i}>
                            <td>{g.gyarto || g.Gyarto}</td>
                            <td>{g.tipus || g.Tipus}</td>
                            <td>{g.ar || g.Ar} Ft</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default NotebookFajlCrud;