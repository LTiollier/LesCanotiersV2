export const ziggyRoute = window.route ?? route

export function getRoute(name, params = {}) {
    if (!name) {
        return null
    }
    try {
        return ziggyRoute(name, params)
    } catch (e) {
        console.warn(`route "${name}" does not exists`)
        return null
    }
}
