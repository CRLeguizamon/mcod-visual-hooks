# MCOD Visual Hooks

Un plugin gratuito para WordPress que te permite agregar elementos visuales atractivos a tu sitio web mediante shortcodes. Este proyecto es de uso libre y gratuito para la comunidad WordPress.

## Características

- Shortcode para mostrar visitantes en vivo con contador animado
- Personalización completa del texto y apariencia
- Configuración de números mínimos y máximos de visitantes
- Intervalo de actualización personalizable
- Color personalizable para el texto y el icono
- Interfaz de administración intuitiva

## Instalación

1. Descarga el plugin
2. Sube el archivo ZIP a tu WordPress en Plugins > Añadir nuevo > Subir plugin
3. Activa el plugin
4. Configura los ajustes en Ganchos Visuales > Visitantes en vivo

## Uso

### Shortcode de Visitantes en Vivo

Usa el siguiente shortcode para mostrar el contador de visitantes:

```
[mcod_visitors]
```

### Configuración

En el panel de administración, puedes configurar:

- Texto personalizado (usa {count} para mostrar el número de visitantes)
- Color del texto y el icono
- Número mínimo y máximo de visitantes
- Intervalo de actualización del contador

## Estructura del Proyecto

```
mcod-visual-hooks/
├── assets/
│   ├── css/
│   ├── js/
│   └── img/
├── includes/
│   ├── class-mcod-visual-hooks.php
│   └── shortcodes/
│       └── class-mcod-visitors-shortcode.php
├── templates/
│   └── admin/
│       ├── admin-page.php
│       └── live-viewing-page.php
├── mcod-visual-hooks.php
└── README.md
```

## Licencia

Este plugin es gratuito y de código abierto. Puedes usarlo libremente en cualquier sitio WordPress sin restricciones.

## Soporte

Si tienes alguna pregunta o necesitas ayuda, puedes:
- Abrir un issue en GitHub
- Contactar al desarrollador en [devcristian.com](https://devcristian.com)

## Changelog

### 1.0.0
- Versión inicial del plugin
- Shortcode para mostrar visitantes en vivo
- Configuración de texto, colores y números
- Interfaz de administración intuitiva 