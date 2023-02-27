const plugin = require("tailwindcss/plugin");

module.exports = plugin(
  function ({ addBase, matchUtilities, addUtilities, theme }) {
    addBase({
      "*, ::before, ::after": {
        "--tw-translate-x": "0",
        "--tw-translate-y": "0",
        "--tw-translate-z": "0",
        "--tw-rotate-x": "0",
        "--tw-rotate-y": "0",
        "--tw-rotate-z": "0",
        "--tw-skew-x": "0",
        "--tw-skew-y": "0",
        "--tw-scale-x": "1",
        "--tw-scale-y": "1",
        "--tw-scale-z": "1",
        // '--tw-self-perspective': '0',
        "--tw-transform": [
          "translateX(var(--tw-translate-x))",
          "translateY(var(--tw-translate-y))",
          "rotateX(var(--tw-rotate-x)) rotateY(var(--tw-rotate-y)) rotateZ(var(--tw-rotate-z))",
          "translateZ(var(--tw-translate-z))",
          "skewX(var(--tw-skew-x))",
          "skewY(var(--tw-skew-y))",
          "scale3d(var(--tw-scale-x), var(--tw-scale-y), var(--tw-scale-z))",
        ].join(" "),
      },
    });

    addUtilities({
      ".transform-style-flat": {
        "transform-style": "flat",
      },
      ".transform-style-3d": {
        "transform-style": "preserve-3d",
      },
      ".backface-visible": {
        "backface-visibility": "visible",
      },
      ".backface-hidden": {
        "backface-visibility": "hidden",
      },
      ".transform-3d-none": { transform: "none" },
    });

    matchUtilities(
      {
        "perspective-origin": (value) => ({
          perspectiveOrigin: value,
        }),
      },
      {
        values: theme("transformOrigin"),
      }
    );

    matchUtilities(
      {
        perspective: (value) => ({
          perspective: value,
        }),
      },
      {
        values: theme("perspectiveValues"),
      }
    );

    // `rotate-x`
    matchUtilities(
      {
        "rotate-x": (value) => ({
          "--tw-rotate-x": value,
          transform: "var(--tw-transform)",
        }),
      },
      {
        values: theme("rotate3d"),
      }
    );

    // `-rotate-x` => rotate-x--*`
    matchUtilities(
      {
        "rotate-x-": (value) => ({
          "--tw-rotate-x": `calc(${value} * -1)`,
          transform: "var(--tw-transform)",
        }),
      },
      {
        values: theme("rotate3d"),
      }
    );

    // `rotate-y`
    matchUtilities(
      {
        "rotate-y": (value) => ({
          "--tw-rotate-y": value,
          transform: "var(--tw-transform)",
        }),
      },
      {
        values: theme("rotate3d"),
      }
    );

    // `-rotate-y` => rotate-y--*`
    matchUtilities(
      {
        "rotate-y-": (value) => ({
          "--tw-rotate-y": `calc(${value} * -1)`,
          transform: "var(--tw-transform)",
        }),
      },
      {
        values: theme("rotate3d"),
      }
    );

    // `rotate-z`
    matchUtilities(
      {
        "rotate-z": (value) => ({
          "--tw-rotate-z": value,
          transform: "var(--tw-transform)",
        }),
      },
      {
        values: theme("rotate3d"),
      }
    );

    // `-rotate-z` => rotate-z--*`
    matchUtilities(
      {
        "rotate-z-": (value) => ({
          "--tw-rotate-z": `calc(${value} * -1)`,
          transform: "var(--tw-transform)",
        }),
      },
      {
        values: theme("rotate3d"),
      }
    );
  },
  {
    theme: {
      perspectiveValues: {
        none: "none",
        1: "100px",
        2: "200px",
        3: "300px",
        4: "600px",
        5: "500px",
        6: "600px",
        7: "700px",
        8: "800px",
        9: "900px",
        10: "1000px",
        "25vw": "25vw",
        "50vw": "50vw",
        "75w": "75vw",
        "100vw": "100vw",
      },
      translate3d: (theme, { negative }) => ({
        ...theme("spacing"),
        ...negative(theme("spacing")),
      }),
      rotate3d: (theme) => ({
        ...theme("rotate"),
        ...{
          10: "10deg",
          15: "15deg",
          20: "20deg",
          25: "25deg",
          30: "30deg",
          35: "35deg",
          40: "40deg",
          50: "50deg",
          60: "60deg",
          70: "70deg",
          80: "80deg",
          90: "90deg",
        },
      }),
    },
  }
);
