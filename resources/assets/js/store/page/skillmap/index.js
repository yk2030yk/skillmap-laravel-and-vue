import store from 'store/page/common'

import toggle                   from 'store/modules/page/skillmap/index/toggle'
import skillTableFilter         from 'store/modules/page/skillmap/index/skillTableFilter'
import certificationTableFilter from 'store/modules/page/skillmap/index/certificationTableFilter'

store.registerModule('toggle', toggle)
store.registerModule('skillTableFilter', skillTableFilter)
store.registerModule('certificationTableFilter', certificationTableFilter)
export default store