import React, { useState, useRef, useEffect, useCallback, useMemo } from 'react';

// Curated garment color palette — hex values only
const COLOR_MAP = {
    white:    '#F5F5F0',
    black:    '#1A1A1A',
    navy:     '#1B2A4A',
    gray:     '#6B7280',
    charcoal: '#374151',
    slate:    '#475569',
    red:      '#C0392B',
    burgundy: '#7B2D3E',
    coral:    '#E05A47',
    blue:     '#2563EB',
    skyblue:  '#38BDF8',
    teal:     '#0D9488',
    green:    '#16A34A',
    olive:    '#6B7C1E',
    yellow:   '#FBBF24',
    orange:   '#EA580C',
    purple:   '#7C3AED',
    lilac:    '#A78BFA',
    pink:     '#EC4899',
    beige:    '#D4B896',
    natural:  '#E8DDD0',
    silver:   '#CBD5E1',
    sand:     '#C5AA7A',
};

// SVG template for the front of a t-shirt (from cloth-t-shirt.svg, front half only)
// viewBox crops to just the front t-shirt. Fill is replaced with the garment color.
const TSHIRT_VIEWBOX = { x: -5, y: 48, w: 520, h: 395 };
function buildTshirtSvg(fillColor) {
    return `<svg xmlns="http://www.w3.org/2000/svg" viewBox="${TSHIRT_VIEWBOX.x} ${TSHIRT_VIEWBOX.y} ${TSHIRT_VIEWBOX.w} ${TSHIRT_VIEWBOX.h}" version="1.1"><g transform="translate(0 -308.27)"><path fill="${fillColor}" stroke="#000000" stroke-width="1.835" d="m8.4716 378.45 187.44-46.53c37.633 19.839 77.716 16.809 119.28 0l190.06 47.842c-1.3669 36.539-11.178 70.733-23.593 104.2l-89.129-1.3107 1.3107 260.83c-91.532 8.5202-183.06 9.3486-274.6-0.65536l-2.63-258.2-87.167-2.63c-8.716-33.71-21.864-56.26-20.971-103.54z"/><path fill="none" stroke="#000000" stroke-width="1.835" d="m195.41 331.92c35.068 69.552 101.18 46.245 119.44 0.16387"/><path fill="none" stroke="#000000" stroke-width=".55051" d="m181 335.68c27.861 82.744 138.53 64.029 150.08 0.49152"/><path fill="none" stroke="#000000" stroke-width=".55051" d="m122.5 350.27c13.448 42.648 20.226 86.185-5.2429 134.02"/><path fill="none" stroke="#000000" stroke-width=".55051" d="m386.14 350.27c-13.448 42.648-20.226 86.185 5.2429 134.02"/></g></svg>`;
}

// Load an SVG string as an HTMLImageElement
function loadSvgImage(svgString) {
    return new Promise((resolve, reject) => {
        const blob = new Blob([svgString], { type: 'image/svg+xml;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        const img = new Image();
        img.onload = () => { resolve(img); URL.revokeObjectURL(url); };
        img.onerror = (err) => { URL.revokeObjectURL(url); reject(err); };
        img.src = url;
    });
}

const PRODUCT_VARIANTS = {
    't-shirt': {
        colors: ['white', 'black', 'navy', 'charcoal', 'gray', 'red', 'burgundy', 'blue', 'teal', 'olive'],
        sizes: ['XS', 'S', 'M', 'L', 'XL', '2XL', '3XL'],
        materials: ['cotton', 'polyester', 'blend', 'organic'],
    },
};

const VARIANT_PRICES = {
    't-shirt': {
        cotton: { XS: 14, S: 15, M: 15, L: 16, XL: 17, '2XL': 19, '3XL': 21 },
        polyester: { XS: 13, S: 14, M: 14, L: 15, XL: 16, '2XL': 18, '3XL': 20 },
        blend: { XS: 15, S: 16, M: 16, L: 17, XL: 18, '2XL': 20, '3XL': 22 },
        organic: { XS: 17, S: 18, M: 18, L: 19, XL: 20, '2XL': 22, '3XL': 24 },
    },
};

function uid() {
    return 'layer_' + Math.random().toString(36).slice(2, 10);
}

function calcPrice(productType, material, size, layerCount) {
    const base = VARIANT_PRICES[productType]?.[material]?.[size] ?? 15;
    return base + layerCount * 2.5;
}

function Notification({ notification }) {
    if (!notification.visible) return null;
    const colors = { 
        success: 'bg-emerald-950/80 border-emerald-500/30 text-emerald-300 shadow-emerald-950/50', 
        error: 'bg-rose-950/80 border-rose-500/30 text-rose-300 shadow-rose-950/50', 
        info: 'bg-indigo-950/80 border-indigo-500/30 text-indigo-300 shadow-indigo-950/50' 
    };
    return (
        <div className={`fixed top-6 right-6 z-50 px-5 py-3 rounded-2xl border backdrop-blur-xl text-sm font-medium shadow-2xl flex items-center gap-3 transition-all duration-300 animate-in fade-in slide-in-from-top-4 ${colors[notification.type] || colors.info}`}>
            <span className="w-2 h-2 rounded-full bg-current animate-pulse"></span>
            {notification.message}
        </div>
    );
}

function SaveModal({ show, designName, setDesignName, onSave, onClose }) {
    if (!show) return null;
    return (
        <div className="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-in fade-in duration-200" onClick={onClose}>
            <div className="bg-slate-900 border border-slate-800 rounded-3xl p-7 w-full max-w-md shadow-2xl relative overflow-hidden" onClick={e => e.stopPropagation()}>
                <div className="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <h3 className="text-xl font-bold text-slate-100 mb-2">Guardar Diseño</h3>
                <p className="text-slate-400 text-xs mb-5">Guardá tu trabajo actual en tu cuenta para continuar editando más tarde.</p>
                <input
                    type="text"
                    value={designName}
                    onChange={e => setDesignName(e.target.value)}
                    placeholder="Escribí el nombre de tu creación..."
                    className="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm mb-6 transition-all"
                    autoFocus
                />
                <div className="flex justify-end gap-3">
                    <button onClick={onClose} className="px-5 py-2.5 text-xs font-semibold text-slate-400 hover:text-slate-200 bg-slate-800/40 hover:bg-slate-800 rounded-xl transition-all">Cancelar</button>
                    <button onClick={onSave} className="px-5 py-2.5 text-xs font-semibold text-white bg-indigo-650 hover:bg-indigo-600 rounded-xl shadow-lg shadow-indigo-600/20 active:scale-95 transition-all">Guardar Diseño</button>
                </div>
            </div>
        </div>
    );
}

function LoadModal({ show, savedDesigns, onLoad, onDelete, onClose }) {
    if (!show) return null;
    return (
        <div className="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-in fade-in duration-200" onClick={onClose}>
            <div className="bg-slate-900 border border-slate-800 rounded-3xl p-7 w-full max-w-lg shadow-2xl relative max-h-[85vh] flex flex-col" onClick={e => e.stopPropagation()}>
                <div className="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <div className="mb-5">
                    <h3 className="text-xl font-bold text-slate-100">Mis Diseños Guardados</h3>
                    <p className="text-slate-400 text-xs mt-1">Hacé clic en cargar para abrir tu diseño en el canvas principal.</p>
                </div>
                
                <div className="flex-1 overflow-y-auto space-y-3 pr-1 max-h-[45vh]">
                    {savedDesigns.length === 0 ? (
                        <div className="text-center py-10 border border-dashed border-slate-800 rounded-2xl">
                            <svg className="w-10 h-10 text-slate-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <p className="text-slate-500 text-sm">No tenés diseños guardados todavía.</p>
                        </div>
                    ) : (
                        savedDesigns.map(d => (
                            <div key={d.id} className="flex items-center justify-between p-4 bg-slate-950/50 hover:bg-slate-950 border border-slate-800/80 rounded-2xl transition-all group">
                                <div>
                                    <p className="text-sm font-semibold text-slate-200 group-hover:text-indigo-400 transition-colors">{d.name}</p>
                                    <p className="text-[10px] text-slate-500 uppercase tracking-wider mt-1">{d.product_type} &middot; <span className="text-emerald-500 font-bold">${Number(d.price || 0).toFixed(2)}</span></p>
                                </div>
                                <div className="flex gap-2">
                                    <button onClick={() => onLoad(d.id)} className="px-3.5 py-2 text-xs font-semibold text-white bg-indigo-650 hover:bg-indigo-600 rounded-xl transition-all shadow-md">Cargar</button>
                                    <button onClick={() => onDelete(d.id)} className="px-3.5 py-2 text-xs font-semibold text-rose-400 hover:text-rose-300 bg-rose-950/30 hover:bg-rose-900/30 border border-rose-900/30 rounded-xl transition-all">Eliminar</button>
                                </div>
                            </div>
                        ))
                    )}
                </div>
                <div className="flex justify-end mt-6 border-t border-slate-800/80 pt-4">
                    <button onClick={onClose} className="px-5 py-2.5 text-xs font-semibold text-slate-400 hover:text-slate-200 bg-slate-800/40 hover:bg-slate-800 rounded-xl transition-all">Cerrar Ventana</button>
                </div>
            </div>
        </div>
    );
}

function ImageUploadModal({ show, onUpload, onClose }) {
    const fileRef = useRef();
    if (!show) return null;
    const handleSubmit = () => {
        const file = fileRef.current?.files?.[0];
        if (file) onUpload(file);
    };
    return (
        <div className="fixed inset-0 bg-slate-950/70 backdrop-blur-sm z-50 flex items-center justify-center p-4 animate-in fade-in duration-200" onClick={onClose}>
            <div className="bg-slate-900 border border-slate-800 rounded-3xl p-7 w-full max-w-md shadow-2xl relative overflow-hidden" onClick={e => e.stopPropagation()}>
                <div className="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                <h3 className="text-xl font-bold text-slate-100 mb-2">Subir Imagen</h3>
                <p className="text-slate-400 text-xs mb-5">Subí logos, ilustraciones o fotos en formato PNG, JPG o WebP.</p>
                <div className="border border-dashed border-slate-800 rounded-2xl p-6 mb-6 text-center hover:border-indigo-500/50 transition-colors">
                    <input ref={fileRef} type="file" accept="image/png,image/jpeg,image/webp" className="w-full text-slate-400 text-xs cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-slate-800 file:text-slate-200 hover:file:bg-slate-700" />
                </div>
                <div className="flex justify-end gap-3">
                    <button onClick={onClose} className="px-5 py-2.5 text-xs font-semibold text-slate-400 hover:text-slate-200 bg-slate-800/40 hover:bg-slate-800 rounded-xl transition-all">Cancelar</button>
                    <button onClick={handleSubmit} className="px-5 py-2.5 text-xs font-semibold text-white bg-indigo-650 hover:bg-indigo-600 rounded-xl shadow-lg shadow-indigo-600/20 active:scale-95 transition-all">Subir Elemento</button>
                </div>
            </div>
        </div>
    );
}

function LayerIcon({ type, layer }) {
    if (type === 'text') return <svg className="w-4 h-4 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h14M4 18h9"/></svg>;
    if (type === 'image') return <svg className="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>;
    return <div className="w-4 h-4 rounded-md shadow-inner" style={{ background: layer?.style?.fill || '#3B82F6', border: '1px solid rgba(255,255,255,0.1)' }} />;
}

function LayersPanel({ layers, selectedLayerId, onSelect, onDelete, onToggleVisibility, onDuplicate, onMoveUp, onMoveDown, onAddText, onAddImage, onAddShape }) {
    return (
        <aside className="w-80 bg-slate-900 border-r border-slate-800 flex flex-col overflow-hidden select-none">
            <div className="p-5 border-b border-slate-850 flex items-center justify-between">
                <div className="flex items-center gap-2">
                    <span className="w-2.5 h-2.5 rounded-full bg-indigo-500 shadow-lg shadow-indigo-500/50"></span>
                    <h3 className="text-xs font-black text-slate-200 uppercase tracking-widest">Capas de Diseño</h3>
                </div>
                <span className="text-[10px] px-2 py-0.5 bg-slate-800 text-slate-400 rounded-full font-bold">{layers.length}</span>
            </div>
            
            <div className="flex-1 overflow-y-auto p-4 space-y-2">
                {layers.map(layer => (
                    <div
                        key={layer.id}
                        className={`flex items-center gap-3 p-3 rounded-2xl border transition-all cursor-pointer ${selectedLayerId === layer.id ? 'border-indigo-500/40 bg-indigo-950/20 shadow-lg shadow-indigo-950/30' : 'bg-slate-950/40 border-slate-850 hover:border-slate-800'}`}
                        onClick={() => onSelect(layer.id)}
                    >
                        <div className="w-8 h-8 flex items-center justify-center bg-slate-900 border border-slate-800 rounded-xl flex-shrink-0">
                            <LayerIcon type={layer.type} layer={layer} />
                        </div>
                        <div className="flex-1 min-w-0">
                            <p className={`text-xs font-bold truncate ${selectedLayerId === layer.id ? 'text-indigo-300' : 'text-slate-300'}`}>
                                {layer.type === 'text' ? layer.content : layer.type === 'image' ? 'Imagen de usuario' : `Forma (${layer.shapeType})`}
                            </p>
                            <p className="text-[9px] text-slate-500 font-medium uppercase mt-0.5 tracking-wider">Z-Index: {layer.zIndex}</p>
                        </div>
                        <div className="flex items-center gap-1">
                            <button onClick={e => { e.stopPropagation(); onToggleVisibility(layer.id); }} className="p-1.5 text-slate-500 hover:text-slate-350 hover:bg-slate-850 rounded-lg transition-all" title={layer.visible ? 'Ocultar' : 'Mostrar'}>
                                {layer.visible
                                    ? <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    : <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59"/></svg>
                                }
                            </button>
                            <button onClick={e => { e.stopPropagation(); onDelete(layer.id); }} className="p-1.5 text-slate-500 hover:text-rose-400 hover:bg-rose-950/20 rounded-lg transition-all" title="Eliminar">
                                <svg className="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </div>
                ))}
                {layers.length === 0 && (
                    <div className="text-center py-10 border border-dashed border-slate-800 rounded-2xl">
                        <p className="text-xs text-slate-500 font-medium">No hay capas activas</p>
                    </div>
                )}
            </div>
            
            <div className="p-4 border-t border-slate-850 space-y-3 bg-slate-900/50 backdrop-blur-sm">
                <div className="grid grid-cols-2 gap-2">
                    <button onClick={onAddText} className="flex items-center justify-center gap-1.5 px-3 py-2.5 text-xs font-bold text-slate-200 bg-slate-800 hover:bg-slate-750 border border-slate-700/50 rounded-xl transition-all active:scale-95">
                        <svg className="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h14M4 18h9"/></svg>
                        Añadir Texto
                    </button>
                    <button onClick={onAddImage} className="flex items-center justify-center gap-1.5 px-3 py-2.5 text-xs font-bold text-slate-200 bg-slate-800 hover:bg-slate-750 border border-slate-700/50 rounded-xl transition-all active:scale-95">
                        <svg className="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Subir Foto
                    </button>
                </div>
                <div className="grid grid-cols-3 gap-2">
                    <button onClick={() => onAddShape('rectangle')} className="py-2 text-slate-350 hover:text-slate-100 bg-slate-800/40 hover:bg-slate-800 border border-slate-700/30 rounded-lg transition-all flex items-center justify-center active:scale-95" title="Rectángulo">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V5z"/></svg>
                    </button>
                    <button onClick={() => onAddShape('circle')} className="py-2 text-slate-350 hover:text-slate-100 bg-slate-800/40 hover:bg-slate-800 border border-slate-700/30 rounded-lg transition-all flex items-center justify-center active:scale-95" title="Círculo">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" strokeWidth="2"/></svg>
                    </button>
                    <button onClick={() => onAddShape('rounded')} className="py-2 text-slate-350 hover:text-slate-100 bg-slate-800/40 hover:bg-slate-800 border border-slate-700/30 rounded-lg transition-all flex items-center justify-center active:scale-95" title="Redondeado">
                        <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="4" y="4" width="16" height="16" rx="4" strokeWidth="2"/></svg>
                    </button>
                </div>
            </div>
        </aside>
    );
}



function PropertiesPanel({ layer, onUpdate }) {
    if (!layer) {
        return (
            <aside className="w-80 bg-slate-900 border-l border-slate-800 flex flex-col overflow-hidden select-none">
                <div className="p-5 border-b border-slate-850">
                    <h3 className="text-xs font-black text-slate-200 uppercase tracking-widest">Propiedades</h3>
                </div>
                <div className="flex-1 flex flex-col items-center justify-center text-center p-6 text-slate-500">
                    <svg className="w-8 h-8 text-slate-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                    <p className="text-xs font-semibold text-slate-400">Ningún elemento seleccionado</p>
                    <p className="text-[10px] text-slate-500 mt-1 max-w-[200px]">Hacé clic en una capa o en el canvas para comenzar a personalizar.</p>
                </div>
            </aside>
        );
    }

    const update = (key, value) => onUpdate(layer.id, { [key]: value });
    const updateStyle = (key, value) => onUpdate(layer.id, { style: { ...layer.style, [key]: value } });

    return (
        <aside className="w-80 bg-slate-900 border-l border-slate-800 flex flex-col overflow-hidden select-none">
            <div className="p-5 border-b border-slate-850 flex items-center justify-between">
                <h3 className="text-xs font-black text-slate-200 uppercase tracking-widest">Propiedades</h3>
                <span className="text-[9px] px-2 py-0.5 bg-indigo-950 text-indigo-300 border border-indigo-850 rounded-full font-bold uppercase">{layer.type}</span>
            </div>
            
            <div className="flex-1 overflow-y-auto p-5 space-y-5">
                {layer.type === 'text' && (
                    <>
                        <div className="space-y-1.5">
                            <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Texto</span>
                            <textarea 
                                value={layer.content} 
                                onChange={e => update('content', e.target.value)} 
                                className="w-full h-20 px-3.5 py-2.5 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm resize-none transition-all"
                            />
                        </div>
                        
                        <div className="space-y-1.5">
                            <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tipografía</span>
                            <select 
                                value={layer.style?.fontFamily || 'Inter'} 
                                onChange={e => updateStyle('fontFamily', e.target.value)} 
                                className="w-full px-3.5 py-2.5 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            >
                                <option>Outfit</option>
                                <option>Inter</option>
                                <option>Arial</option>
                                <option>Georgia</option>
                                <option>Courier New</option>
                            </select>
                        </div>
                        
                        <div className="grid grid-cols-2 gap-3">
                            <div className="space-y-1.5">
                                <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Tamaño</span>
                                <input 
                                    type="number" 
                                    value={layer.style?.fontSize || 32} 
                                    onChange={e => updateStyle('fontSize', Number(e.target.value))} 
                                    className="w-full px-3 py-2 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                />
                            </div>
                            <div className="space-y-1.5">
                                <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Color</span>
                                <div className="flex gap-2 items-center">
                                    <input 
                                        type="color" 
                                        value={layer.style?.color || '#000000'} 
                                        onChange={e => updateStyle('color', e.target.value)} 
                                        className="w-10 h-9 bg-transparent border-0 cursor-pointer rounded-lg p-0"
                                    />
                                    <span className="text-xs font-mono text-slate-450 uppercase">{layer.style?.color || '#000000'}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div className="space-y-1.5">
                            <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alineación</span>
                            <div className="flex bg-slate-950 p-1 rounded-xl border border-slate-850">
                                {['left', 'center', 'right'].map(a => (
                                    <button 
                                        key={a} 
                                        onClick={() => updateStyle('textAlign', a)} 
                                        className={`flex-1 py-1.5 text-xs font-semibold rounded-lg transition-all ${layer.style?.textAlign === a ? 'bg-indigo-650 text-white shadow-md' : 'text-slate-400 hover:text-slate-200'}`}
                                    >
                                        {a === 'left' ? 'Izq' : a === 'center' ? 'Centro' : 'Der'}
                                    </button>
                                ))}
                            </div>
                        </div>
                    </>
                )}

                {layer.type === 'shape' && (
                    <div className="grid grid-cols-2 gap-3">
                        <div className="space-y-1.5">
                            <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Relleno</span>
                            <div className="flex items-center gap-1.5">
                                <input 
                                    type="color" 
                                    value={layer.style?.fill || '#3B82F6'} 
                                    onChange={e => updateStyle('fill', e.target.value)} 
                                    className="w-9 h-9 bg-transparent border-0 cursor-pointer rounded-lg p-0"
                                />
                                <span className="text-[10px] font-mono text-slate-450 uppercase">{layer.style?.fill || '#3B82F6'}</span>
                            </div>
                        </div>
                        <div className="space-y-1.5">
                            <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Borde</span>
                            <div className="flex items-center gap-1.5">
                                <input 
                                    type="color" 
                                    value={layer.style?.stroke || '#000000'} 
                                    onChange={e => updateStyle('stroke', e.target.value)} 
                                    className="w-9 h-9 bg-transparent border-0 cursor-pointer rounded-lg p-0"
                                />
                                <span className="text-[10px] font-mono text-slate-450 uppercase">{layer.style?.stroke || '#000000'}</span>
                            </div>
                        </div>
                    </div>
                )}

                <div className="h-[1px] bg-slate-850 my-2"></div>

                <div className="grid grid-cols-2 gap-3">
                    <div className="space-y-1.5">
                        <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Ancho (px)</span>
                        <input 
                            type="number" 
                            value={layer.width} 
                            onChange={e => update('width', Number(e.target.value))} 
                            className="w-full px-3 py-2 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                    <div className="space-y-1.5">
                        <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Alto (px)</span>
                        <input 
                            type="number" 
                            value={layer.height} 
                            onChange={e => update('height', Number(e.target.value))} 
                            className="w-full px-3 py-2 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                </div>
                
                <div className="grid grid-cols-2 gap-3">
                    <div className="space-y-1.5">
                        <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Posición X</span>
                        <input 
                            type="number" 
                            value={Math.round(layer.x)} 
                            onChange={e => update('x', Number(e.target.value))} 
                            className="w-full px-3 py-2 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                    <div className="space-y-1.5">
                        <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Posición Y</span>
                        <input 
                            type="number" 
                            value={Math.round(layer.y)} 
                            onChange={e => update('y', Number(e.target.value))} 
                            className="w-full px-3 py-2 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                </div>
                
                <div className="grid grid-cols-2 gap-3">
                    <div className="space-y-1.5">
                        <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Rotación</span>
                        <input 
                            type="number" 
                            value={layer.rotation || 0} 
                            onChange={e => update('rotation', Number(e.target.value))} 
                            className="w-full px-3 py-2 bg-slate-950 border border-slate-850 rounded-xl text-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        />
                    </div>
                    <div className="space-y-1.5 flex flex-col justify-end">
                        <span className="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Opacidad</span>
                        <div className="flex items-center gap-2">
                            <input 
                                type="range" 
                                min="0" 
                                max="1" 
                                step="0.1" 
                                value={layer.opacity ?? 1} 
                                onChange={e => update('opacity', Number(e.target.value))} 
                                className="w-full h-1.5 bg-slate-950 rounded-lg appearance-none cursor-pointer accent-indigo-500"
                            />
                            <span className="text-xs font-mono font-bold text-slate-400 w-8 text-right">{Math.round((layer.opacity ?? 1) * 100)}%</span>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    );
}

export default function CustomizerApp() {
    const canvasRef = useRef(null);
    const containerRef = useRef(null);
    const imageCache = useRef({});

    const [canvas, setCanvas] = useState({ width: 800, height: 600, background: '#0b0f19', grid: true, gridSize: 20 });
    const [layers, setLayers] = useState([]);
    const [selectedLayerId, setSelectedLayerId] = useState(null);
    const [productType, setProductType] = useState('t-shirt');
    const [selectedVariants, setSelectedVariants] = useState({ color: 'white', size: 'M', material: 'cotton' });
    const [zoom, setZoom] = useState(1);
    const [dragging, setDragging] = useState(null);
    const [pan, setPan] = useState({ x: 0, y: 0 });
    const [isPanning, setIsPanning] = useState(false);
    const [panStart, setPanStart] = useState({ x: 0, y: 0 });
    const [garmentImage, setGarmentImage] = useState(null);

    const [designId, setDesignId] = useState(null);
    const [designName, setDesignName] = useState('');
    const [showSaveModal, setShowSaveModal] = useState(false);
    const [showLoadModal, setShowLoadModal] = useState(false);
    const [showImageUpload, setShowImageUpload] = useState(false);
    const [savedDesigns, setSavedDesigns] = useState([]);
    const [notification, setNotification] = useState({ visible: false, type: 'info', message: '' });

    const selectedLayer = useMemo(() => layers.find(l => l.id === selectedLayerId) || null, [layers, selectedLayerId]);
    const variants = PRODUCT_VARIANTS[productType] || PRODUCT_VARIANTS['t-shirt'];
    const totalPrice = useMemo(() => calcPrice(productType, selectedVariants.material, selectedVariants.size, layers.length), [productType, selectedVariants, layers.length]);

    const notify = useCallback((message, type = 'info') => {
        setNotification({ visible: true, type, message });
        setTimeout(() => setNotification(n => ({ ...n, visible: false })), 4000);
    }, []);

    const selectedLayerIdx = useMemo(() => layers.findIndex(l => l.id === selectedLayerId), [layers, selectedLayerId]);

    const addTextLayer = useCallback(() => {
        const layer = {
            id: uid(), type: 'text', content: 'Tu texto aquí',
            x: canvas.width / 2, y: canvas.height / 2, width: 200, height: 50,
            rotation: 0, opacity: 1, zIndex: layers.length + 1,
            style: { fontFamily: 'Inter', fontSize: 32, fontWeight: '600', color: '#000000', textAlign: 'center', lineHeight: 1.2 },
            locked: false, visible: true,
        };
        setLayers(prev => [...prev, layer]);
        setSelectedLayerId(layer.id);
    }, [canvas, layers.length]);

    const addShapeLayer = useCallback((shape) => {
        const style = {
            fill: '#3B82F6', stroke: 'transparent', strokeWidth: 0,
            borderRadius: shape === 'circle' ? '50%' : shape === 'rounded' ? '20px' : '0',
        };
        const layer = {
            id: uid(), type: 'shape', shapeType: shape, content: null,
            x: canvas.width / 2, y: canvas.height / 2, width: 100, height: 100,
            rotation: 0, opacity: 1, zIndex: layers.length + 1,
            style, locked: false, visible: true,
        };
        setLayers(prev => [...prev, layer]);
        setSelectedLayerId(layer.id);
    }, [canvas, layers.length]);

    const addImageLayer = useCallback((file) => {
        const url = URL.createObjectURL(file);
        const img = new Image();
        img.onload = () => {
            const maxW = 300, maxH = 300;
            let w = img.width, h = img.height;
            if (w > maxW) { h = (maxW / w) * h; w = maxW; }
            if (h > maxH) { w = (maxH / h) * w; h = maxH; }
            const layer = {
                id: uid(), type: 'image', content: url,
                x: canvas.width / 2, y: canvas.height / 2, width: Math.round(w), height: Math.round(h),
                rotation: 0, opacity: 1, zIndex: layers.length + 1,
                style: { objectFit: 'cover' }, locked: false, visible: true,
            };
            setLayers(prev => [...prev, layer]);
            setSelectedLayerId(layer.id);
            imageCache.current[url] = img;
        };
        img.src = url;
        setShowImageUpload(false);
    }, [canvas, layers.length]);

    const deleteLayer = useCallback((id) => {
        setLayers(prev => prev.filter(l => l.id !== id));
        setSelectedLayerId(prev => prev === id ? null : prev);
    }, []);

    const toggleVisibility = useCallback((id) => {
        setLayers(prev => prev.map(l => l.id === id ? { ...l, visible: !l.visible } : l));
    }, []);

    const duplicateLayer = useCallback((id) => {
        setLayers(prev => {
            const idx = prev.findIndex(l => l.id === id);
            if (idx === -1) return prev;
            const copy = { ...prev[idx], id: uid(), x: prev[idx].x + 20, y: prev[idx].y + 20, zIndex: prev.length + 1 };
            setSelectedLayerId(copy.id);
            return [...prev, copy];
        });
    }, []);

    const updateLayer = useCallback((id, data) => {
        setLayers(prev => prev.map(l => {
            if (l.id !== id) return l;
            if (data.style) return { ...l, ...data, style: { ...l.style, ...data.style } };
            return { ...l, ...data };
        }));
    }, []);

    const moveLayer = useCallback((id, dir) => {
        setLayers(prev => {
            const idx = prev.findIndex(l => l.id === id);
            if (idx === -1) return prev;
            const newIdx = dir === 'up' ? idx + 1 : idx - 1;
            if (newIdx < 0 || newIdx >= prev.length) return prev;
            const next = [...prev];
            [next[idx], next[newIdx]] = [next[newIdx], next[idx]];
            return next.map((l, i) => ({ ...l, zIndex: i + 1 }));
        });
    }, []);

    const clearCanvas = useCallback(() => {
        if (confirm('¿Limpiar todo el lienzo?')) {
            setLayers([]);
            setSelectedLayerId(null);
        }
    }, []);

    const toggleGrid = useCallback(() => setCanvas(c => ({ ...c, grid: !c.grid })), []);

    const handleImageUpload = useCallback(async (file) => {
        const formData = new FormData();
        formData.append('file', file);
        formData.append('type', 'logo');

        if (designId) {
            try {
                const res = await fetch(`/api/designs/${designId}/assets`, { method: 'POST', body: formData });
                const data = await res.json();
                if (data.success) {
                    addImageLayer(file);
                    notify('Imagen subida');
                    return;
                }
            } catch (e) { /* fall through to local add */ }
        }
        addImageLayer(file);
    }, [designId, addImageLayer, notify]);

    const saveDesign = useCallback(async () => {
        if (!designName.trim()) { notify('Ingresa un nombre', 'error'); return; }
        try {
            const url = designId ? `/api/designs/${designId}` : '/api/designs';
            const method = designId ? 'PUT' : 'POST';
            const res = await fetch(url, {
                method, headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ name: designName, product_type: productType, canvas, layers, selected_variants: selectedVariants, price: totalPrice }),
            });
            const data = await res.json();
            if (data.success) {
                setDesignId(data.design.id);
                setDesignName(data.design.name);
                setShowSaveModal(false);
                notify('Diseño guardado');
                loadSavedDesigns();
            } else {
                notify('Error al guardar', 'error');
            }
        } catch (e) {
            notify('Error de red', 'error');
        }
    }, [designName, designId, productType, canvas, layers, selectedVariants, totalPrice, notify]);

    const loadSavedDesigns = useCallback(async () => {
        try {
            const res = await fetch('/api/designs');
            const data = await res.json();
            if (data.success) setSavedDesigns(data.designs);
        } catch (e) { /* silent */ }
    }, []);

    const loadDesign = useCallback(async (id) => {
        try {
            const res = await fetch(`/api/designs/${id}`);
            const data = await res.json();
            if (data.success) {
                const d = data.design;
                setDesignId(d.id);
                setDesignName(d.name);
                setProductType(d.product_type);
                if (d.canvas) setCanvas(c => ({ ...c, ...d.canvas }));
                setLayers(d.layers || []);
                if (d.selected_variants) setSelectedVariants(d.selected_variants);
                setSelectedLayerId(null);
                setShowLoadModal(false);
                notify('Diseño cargado');
            }
        } catch (e) { notify('Error al cargar', 'error'); }
    }, [notify]);

    const deleteDesign = useCallback(async (id) => {
        try {
            await fetch(`/api/designs/${id}`, { method: 'DELETE' });
            setSavedDesigns(prev => prev.filter(d => d.id !== id));
            notify('Diseño eliminado');
        } catch (e) { /* silent */ }
    }, [notify]);

    const downloadPNG = useCallback(() => {
        const offscreen = document.createElement('canvas');
        offscreen.width = canvas.width;
        offscreen.height = canvas.height;
        const ctx = offscreen.getContext('2d');
        ctx.fillStyle = canvas.background;
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        const sorted = [...layers].sort((a, b) => (a.zIndex || 0) - (b.zIndex || 0));
        let pending = 0;
        const finish = () => {
            if (pending > 0) return;
            offscreen.toBlob(blob => {
                const url = URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url; a.download = `diseno-${Date.now()}.png`; a.click();
                URL.revokeObjectURL(url);
            }, 'image/png');
        };

        for (const layer of sorted) {
            if (!layer.visible) continue;
            ctx.save();
            ctx.globalAlpha = layer.opacity ?? 1;
            const x = layer.x - (layer.width || 0) / 2;
            const y = layer.y - (layer.height || 0) / 2;
            ctx.translate(layer.x, layer.y);
            ctx.rotate((layer.rotation || 0) * Math.PI / 180);
            ctx.translate(-layer.x, -layer.y);

            if (layer.type === 'text') {
                drawTextOnCtx(ctx, layer, x, y);
            } else if (layer.type === 'shape') {
                drawShapeOnCtx(ctx, layer, x, y);
            } else if (layer.type === 'image') {
                pending++;
                const img = new Image();
                img.crossOrigin = 'anonymous';
                img.onload = () => { ctx.drawImage(img, x, y, layer.width, layer.height); ctx.restore(); pending--; finish(); };
                img.onerror = () => { ctx.restore(); pending--; finish(); };
                img.src = layer.content;
                continue;
            }
            ctx.restore();
        }
        finish();
    }, [canvas, layers]);

    function drawTextOnCtx(ctx, layer, x, y) {
        const s = layer.style || {};
        ctx.font = `${s.fontWeight || '600'} ${s.fontSize || 32}px ${s.fontFamily || 'Inter'}`;
        ctx.fillStyle = s.color || '#000';
        ctx.textAlign = s.textAlign || 'center';
        ctx.textBaseline = 'middle';
        const lines = (layer.content || '').split('\n');
        const lh = (s.fontSize || 32) * (s.lineHeight || 1.2);
        lines.forEach((line, i) => {
            const ly = y + (layer.height || 0) / 2 - (lines.length - 1) * lh / 2 + i * lh;
            let lx = x + (layer.width || 0) / 2;
            if (s.textAlign === 'left') lx = x;
            if (s.textAlign === 'right') lx = x + (layer.width || 0);
            ctx.fillText(line, lx, ly);
        });
    }

    function drawShapeOnCtx(ctx, layer, x, y) {
        const s = layer.style || {};
        const w = layer.width, h = layer.height;
        ctx.beginPath();
        if (layer.shapeType === 'circle') {
            ctx.arc(x + w / 2, y + h / 2, Math.min(w, h) / 2, 0, Math.PI * 2);
        } else {
            const r = s.borderRadius ? parseInt(s.borderRadius) : 0;
            if (r > 0) ctx.roundRect(x, y, w, h, r);
            else ctx.rect(x, y, w, h);
        }
        if (s.fill && s.fill !== 'transparent') { ctx.fillStyle = s.fill; ctx.fill(); }
        if (s.stroke && s.stroke !== 'transparent' && s.strokeWidth > 0) { ctx.strokeStyle = s.stroke; ctx.lineWidth = s.strokeWidth; ctx.stroke(); }
    }

    function drawProductTemplate(ctx, w, h, type, color) {
        if (!garmentImage) return { x: 0, y: 0, width: w, height: h };
        // Fit the SVG t-shirt image into the canvas (preserve aspect ratio)
        const imgAspect = TSHIRT_VIEWBOX.w / TSHIRT_VIEWBOX.h;
        const canvasAspect = w / h;
        let drawW, drawH;
        if (imgAspect > canvasAspect) { drawW = w * 0.85; drawH = drawW / imgAspect; }
        else { drawH = h * 0.85; drawW = drawH * imgAspect; }
        const drawX = (w - drawW) / 2;
        const drawY = (h - drawH) / 2;

        ctx.save();
        ctx.shadowColor = "rgba(0, 0, 0, 0.40)";
        ctx.shadowBlur = 24;
        ctx.shadowOffsetY = 8;
        ctx.drawImage(garmentImage, drawX, drawY, drawW, drawH);
        ctx.restore();

        // Printable zone overlay (dashed rectangle)
        const pz = {
            x: drawX + drawW * 0.25,
            y: drawY + drawH * 0.20,
            width: drawW * 0.50,
            height: drawH * 0.45,
        };
        ctx.setLineDash([6, 6]);
        ctx.strokeStyle = "rgba(99, 102, 241, 0.35)";
        ctx.lineWidth = 1.5;
        ctx.strokeRect(pz.x, pz.y, pz.width, pz.height);
        ctx.setLineDash([]);
        return pz;
    }

    function drawImageOnCtx(ctx, layer, x, y) {
        const cached = imageCache.current[layer.content];
        if (cached && cached.complete) {
            ctx.drawImage(cached, x, y, layer.width, layer.height);
            return false;
        }
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = () => { imageCache.current[layer.content] = img; };
        img.src = layer.content;
        return true;
    }

    useEffect(() => {
        const cvs = canvasRef.current;
        if (!cvs) return;
        const ctx = cvs.getContext('2d');
        cvs.width = canvas.width;
        cvs.height = canvas.height;

        ctx.fillStyle = canvas.background;
        ctx.fillRect(0, 0, canvas.width, canvas.height);

        // Draw grid in the background first
        if (canvas.grid) {
            const size = canvas.gridSize;
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.035)';
            ctx.lineWidth = 0.5;
            for (let x = 0; x <= canvas.width; x += size) { ctx.beginPath(); ctx.moveTo(x, 0); ctx.lineTo(x, canvas.height); ctx.stroke(); }
            for (let y = 0; y <= canvas.height; y += size) { ctx.beginPath(); ctx.moveTo(0, y); ctx.lineTo(canvas.width, y); ctx.stroke(); }
        }

        drawProductTemplate(ctx, canvas.width, canvas.height, productType, COLOR_MAP[selectedVariants.color] || selectedVariants.color);

        const sorted = [...layers].sort((a, b) => (a.zIndex || 0) - (b.zIndex || 0));
        for (const layer of sorted) {
            if (!layer.visible) continue;
            ctx.save();
            ctx.globalAlpha = layer.opacity ?? 1;
            const x = layer.x - (layer.width || 0) / 2;
            const y = layer.y - (layer.height || 0) / 2;
            ctx.translate(layer.x, layer.y);
            ctx.rotate((layer.rotation || 0) * Math.PI / 180);
            ctx.translate(-layer.x, -layer.y);

            if (layer.type === 'text') drawTextOnCtx(ctx, layer, x, y);
            else if (layer.type === 'shape') drawShapeOnCtx(ctx, layer, x, y);
            else if (layer.type === 'image') drawImageOnCtx(ctx, layer, x, y);

            ctx.restore();

            if (layer.id === selectedLayerId) {
                ctx.strokeStyle = '#3B82F6';
                ctx.lineWidth = 2 / zoom;
                ctx.setLineDash([6 / zoom, 6 / zoom]);
                ctx.strokeRect(x - 2 / zoom, y - 2 / zoom, (layer.width || 0) + 4 / zoom, (layer.height || 0) + 4 / zoom);
                ctx.setLineDash([]);
            }
        }
    }, [canvas, layers, selectedLayerId, zoom, productType, selectedVariants.color, garmentImage]);

    const canvasMouseDown = useCallback((e) => {
        const rect = canvasRef.current.getBoundingClientRect();
        const x = (e.clientX - rect.left) / zoom;
        const y = (e.clientY - rect.top) / zoom;

        for (let i = layers.length - 1; i >= 0; i--) {
            const l = layers[i];
            if (!l.visible) continue;
            const lx = l.x - (l.width || 0) / 2;
            const ly = l.y - (l.height || 0) / 2;
            if (x >= lx && x <= lx + (l.width || 0) && y >= ly && y <= ly + (l.height || 0)) {
                setSelectedLayerId(l.id);
                setDragging({ id: l.id, startX: e.clientX, startY: e.clientY, origX: l.x, origY: l.y });
                return;
            }
        }
        setIsPanning(true);
        setPanStart({ x: e.clientX - pan.x, y: e.clientY - pan.y });
    }, [layers, zoom, pan]);

    const canvasMouseMove = useCallback((e) => {
        if (dragging) {
            const dx = (e.clientX - dragging.startX) / zoom;
            const dy = (e.clientY - dragging.startY) / zoom;
            updateLayer(dragging.id, { x: Math.round(dragging.origX + dx), y: Math.round(dragging.origY + dy) });
        } else if (isPanning) {
            setPan({ x: e.clientX - panStart.x, y: e.clientY - panStart.y });
        }
    }, [dragging, isPanning, panStart, zoom, updateLayer]);

    const canvasMouseUp = useCallback(() => {
        setDragging(null);
        setIsPanning(false);
    }, []);

    const canvasWheel = useCallback((e) => {
        e.preventDefault();
        const delta = e.deltaY > 0 ? 0.9 : 1.1;
        setZoom(z => Math.max(0.25, Math.min(3, z * delta)));
    }, []);

    useEffect(() => {
        const handler = (e) => {
            if (e.key === 'Delete' && selectedLayerId) deleteLayer(selectedLayerId);
        };
        window.addEventListener('keydown', handler);
        return () => window.removeEventListener('keydown', handler);
    }, [selectedLayerId, deleteLayer]);

    useEffect(() => { loadSavedDesigns(); }, [loadSavedDesigns]);

    // Load the t-shirt SVG (recolor) whenever the selected color changes
    useEffect(() => {
        let cancelled = false;
        const colorHex = COLOR_MAP[selectedVariants.color] || selectedVariants.color || '#F5F5F0';
        loadSvgImage(buildTshirtSvg(colorHex))
            .then(img => { if (!cancelled) setGarmentImage(img); })
            .catch(() => {});
        return () => { cancelled = true; };
    }, [selectedVariants.color]);

    return (
        <div className="h-screen flex flex-col bg-slate-950 text-slate-100 font-sans">
            <Notification notification={notification} />
            <SaveModal show={showSaveModal} designName={designName} setDesignName={setDesignName} onSave={saveDesign} onClose={() => setShowSaveModal(false)} />
            <LoadModal show={showLoadModal} savedDesigns={savedDesigns} onLoad={loadDesign} onDelete={deleteDesign} onClose={() => setShowLoadModal(false)} />
            <ImageUploadModal show={showImageUpload} onUpload={handleImageUpload} onClose={() => setShowImageUpload(false)} />

            {/* Header / Top Navbar */}
            <header className="bg-slate-900/80 backdrop-blur-md border-b border-slate-800/80 px-6 py-4 sticky top-0 z-40">
                <div className="max-w-7xl mx-auto flex items-center justify-between gap-4">
                    <div className="flex items-center gap-6">
                        <div className="flex items-center gap-2">
                            <span className="w-3.5 h-3.5 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-600 shadow-lg shadow-indigo-500/30"></span>
                            <a href="/" className="text-lg font-black tracking-wider bg-gradient-to-r from-white to-slate-400 bg-clip-text text-transparent uppercase">WILBERTH</a>
                        </div>
                        
                        <div className="h-4 w-[1px] bg-slate-800"></div>
                        
                        <span className="text-[10px] font-bold text-slate-500 uppercase tracking-widest hidden sm:inline">Camiseta</span>
                    </div>

                    <div className="flex items-center gap-3">
                        <button 
                            onClick={() => { setLayers([]); setSelectedLayerId(null); setDesignId(null); setDesignName(''); notify('Nuevo lienzo creado', 'info'); }} 
                            className="px-4 py-2 text-xs font-semibold text-slate-400 hover:text-slate-200 bg-slate-800/40 hover:bg-slate-800 rounded-xl transition-all active:scale-95"
                        >
                            Nuevo
                        </button>
                        
                        <button 
                            onClick={() => setShowSaveModal(true)} 
                            className="px-4 py-2 text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-500 rounded-xl transition-all shadow-md shadow-indigo-650/10 active:scale-95"
                        >
                            {designId ? 'Actualizar' : 'Guardar'}
                        </button>
                        
                        <button 
                            onClick={() => { loadSavedDesigns(); setShowLoadModal(true); }} 
                            className="px-4 py-2 text-xs font-semibold text-slate-400 hover:text-slate-200 bg-slate-800/40 hover:bg-slate-800 border border-slate-700/30 rounded-xl transition-all active:scale-95"
                        >
                            Cargar
                        </button>
                        
                        <div className="h-8 w-[1px] bg-slate-800 mx-1"></div>

                        {/* Price Estimator */}
                        <div className="flex items-center gap-2 px-4 py-2 bg-emerald-950/40 border border-emerald-900/30 rounded-xl shadow-lg">
                            <span className="text-[9px] font-bold text-emerald-400 uppercase tracking-widest">Precio:</span>
                            <span className="text-xs font-bold text-emerald-300">${totalPrice.toFixed(2)}</span>
                        </div>
                    </div>
                </div>
            </header>

            {/* Layout Panels */}
            <div className="flex-1 flex overflow-hidden">
                <LayersPanel
                    layers={layers} selectedLayerId={selectedLayerId}
                    onSelect={setSelectedLayerId} onDelete={deleteLayer} onToggleVisibility={toggleVisibility}
                    onDuplicate={duplicateLayer} onMoveUp={id => moveLayer(id, 'up')} onMoveDown={id => moveLayer(id, 'down')}
                    onAddText={addTextLayer} onAddImage={() => setShowImageUpload(true)} onAddShape={addShapeLayer}
                />

                {/* Main Studio Viewport */}
                <main className="flex-1 flex flex-col overflow-hidden bg-slate-950 relative">
                    <div className="absolute inset-0 bg-[radial-gradient(#ffffff03_1px,transparent_1px)] [background-size:24px_24px] pointer-events-none"></div>
                    


                    {/* Canvas Wrapper */}
                    <div className="flex-1 flex items-center justify-center relative overflow-hidden p-8" ref={containerRef}>
                        <div className="relative transition-transform duration-75" style={{ transform: `scale(${zoom})`, transformOrigin: 'center center' }}>
                            <canvas
                                ref={canvasRef}
                                width={canvas.width}
                                height={canvas.height}
                                className="bg-slate-900 border border-slate-800 shadow-2xl shadow-black/80 rounded-3xl cursor-crosshair"
                                onMouseDown={canvasMouseDown}
                                onMouseMove={canvasMouseMove}
                                onMouseUp={canvasMouseUp}
                                onMouseLeave={canvasMouseUp}
                                onWheel={canvasWheel}
                                onContextMenu={e => e.preventDefault()}
                            />
                        </div>
                    </div>

                    {/* Footer Glassmorphic Tools */}
                    <div className="bg-slate-900/40 backdrop-blur-md border-t border-slate-800/80 px-6 py-4 flex items-center justify-between gap-4 z-15">
                        <div className="flex items-center gap-4">
                            {/* Zoom controls */}
                            <div className="flex items-center bg-slate-950 rounded-xl p-1 border border-slate-800">
                                <button onClick={() => setZoom(z => Math.max(0.25, z / 1.2))} className="p-1.5 text-slate-400 hover:text-slate-200 hover:bg-slate-900 rounded-lg transition-colors">
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M20 12H4"/></svg>
                                </button>
                                <span className="w-14 text-center text-xs font-mono font-bold text-slate-400">{Math.round(zoom * 100)}%</span>
                                <button onClick={() => setZoom(z => Math.min(3, z * 1.2))} className="p-1.5 text-slate-400 hover:text-slate-200 hover:bg-slate-900 rounded-lg transition-colors">
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                </button>
                                <button onClick={() => { setZoom(1); setPan({ x: 0, y: 0 }); }} className="p-1.5 text-slate-550 hover:text-slate-350 hover:bg-slate-900 rounded-lg transition-colors" title="Restaurar Zoom">
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                </button>
                            </div>

                            <div className="h-5 w-[1px] bg-slate-800"></div>

                            {/* Grid / Reset controls */}
                            <div className="flex items-center gap-2">
                                <button 
                                    onClick={toggleGrid} 
                                    className={`p-2 rounded-xl transition-all border ${canvas.grid ? 'bg-indigo-950/40 text-indigo-400 border-indigo-500/30' : 'text-slate-400 hover:text-slate-200 bg-slate-950/20 border-slate-800'}`} 
                                    title="Alternar cuadrícula"
                                >
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 4v16h16V4H4zm12 0v16m-8-16v16"/></svg>
                                </button>
                                <button 
                                    onClick={clearCanvas} 
                                    className="p-2 text-rose-400 hover:text-rose-300 hover:bg-rose-950/20 border border-rose-950/10 rounded-xl transition-all" 
                                    title="Limpiar Diseño"
                                >
                                    <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </div>

                        <div className="h-5 w-[1px] bg-slate-800"></div>

                        {/* Color Picker — Color de Prenda */}
                        <div className="flex items-center gap-2.5">
                            <span className="text-[10px] font-black text-slate-500 uppercase tracking-widest whitespace-nowrap">Color</span>
                            <div className="flex gap-1.5 flex-wrap">
                                {PRODUCT_VARIANTS[productType]?.colors.map(col => (
                                    <button
                                        key={col}
                                        onClick={() => setSelectedVariants(prev => ({ ...prev, color: col }))}
                                        className={`w-6 h-6 rounded-full border-2 transition-all hover:scale-110 ${
                                            selectedVariants.color === col
                                                ? 'border-indigo-400 scale-110 ring-2 ring-indigo-500/30'
                                                : 'border-slate-700 hover:border-slate-500'
                                        }`}
                                        style={{ backgroundColor: COLOR_MAP[col] || '#888888' }}
                                        title={col}
                                    />
                                ))}
                            </div>
                        </div>

                        {/* Export Action */}
                        <div>
                            <button 
                                onClick={downloadPNG} 
                                className="px-5 py-2.5 text-xs font-bold text-white bg-gradient-to-r from-indigo-650 to-purple-650 hover:from-indigo-600 hover:to-purple-600 rounded-xl transition-all shadow-lg shadow-indigo-600/15 active:scale-95 flex items-center gap-2"
                            >
                                <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Exportar PNG
                            </button>
                        </div>
                    </div>

                </main>

                <PropertiesPanel layer={selectedLayer} onUpdate={updateLayer} />
            </div>
        </div>
    );
}
