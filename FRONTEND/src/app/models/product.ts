export interface Talla {
    id: number; 
    talla: string; 
    pivot: {
        producto_id: number; 
        talla_id: number; 
        cantidad: number; 
    };
}


export interface Producto {
    id: number;                
    nombre: string;           
    descripcion: string;       
    precio: number;            
    color: string; 
    sexo: string;
    categoria: string;            
    imagen: string;           
    tallas: Talla[];           
}
