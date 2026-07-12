import React from 'react';
import { createRoot } from 'react-dom/client';
import CustomizerApp from './components/CustomizerApp';
import '../css/app.css';

const el = document.getElementById('customizer-root');
if (el) {
    createRoot(el).render(<CustomizerApp />);
}
