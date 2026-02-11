import { createViteConfig } from "vite-config-factory";

const entries = {
    'css/modularity-alingsashero': './source/sass/modularity-alingsashero.scss',
    'js/modularity-alingsashero': './source/js/modularity-alingsashero.js',
};

export default createViteConfig(entries, {
    outDir: "dist",
    manifestFile: "manifest.json",
});
