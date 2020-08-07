export default {
	methods: {
		getMemberById(id) {
			return this.members.find((member) => { return member.id == id; });
		},
	},
}